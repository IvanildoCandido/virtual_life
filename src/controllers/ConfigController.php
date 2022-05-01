<?php

namespace src\controllers;

use \core\Controller;
use \src\handlers\UserHandler;
use \src\models\User;

class ConfigController extends Controller
{
    private $loggedUser;

    public function __construct()
    {
        $this->loggedUser = UserHandler::checkLogin();
        if ($this->loggedUser === false) {
            $this->redirect('/login');
        }
    }

    public function index($args = [])
    {
        $flash = '';
        if (!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }
        $this->render('config', [
            'loggedUser' => $this->loggedUser,
            'flash' => $flash
        ]);
    }
    public function configAction()
    {
        $name = filter_input(INPUT_POST, 'name');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');
        $confirmPassword = filter_input(INPUT_POST, 'confirmPassword');
        $day = filter_input(INPUT_POST, 'day');
        $month = filter_input(INPUT_POST, 'month');
        $year = filter_input(INPUT_POST, 'year');
        $city = filter_input(INPUT_POST, 'city');
        $work = filter_input(INPUT_POST, 'work');

        $birthdate = "$year-$month-$day";

        if ($birthdate !== $this->loggedUser->getBirthdate()) {
            $newBirthdate = UserHandler::checkDate("$year/$month/$day", null);
            if ($newBirthdate === false) {
                $_SESSION['flash'] =  "Favor digitar uma data válida!";
                $this->redirect('/config');
            }
        }

        if ($password) {
            if ($password !== $confirmPassword) {
                $_SESSION['flash'] =  "As senhas digitadas são diferentes!";
                $this->redirect('/config');
            }
            UserHandler::alterPassword($this->loggedUser->getId(), $password);
        }

        if ($email !== $this->loggedUser->getEmail()) {
            if (!UserHandler::emailExists($email)) {
                $_SESSION['flash'] =  "Email já existente!";
                $this->redirect('/config');
            }
        }
        User::update()
            ->set('name', $name)
            ->set('email', $email)
            ->set('city', $city)
            ->set('work', $work)
            ->set('birthdate', $birthdate)
            ->where('id', $this->loggedUser->getId())
            ->execute();
        $this->redirect('/config');
    }
}
