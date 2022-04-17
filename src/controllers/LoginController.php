<?php

namespace src\controllers;

use \core\Controller;
use \src\handlers\LoginHandler;

class LoginController extends Controller
{

    public function signin()
    {
        $flash = '';
        if (!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }
        $this->render('login', ['flash' => $flash]);
    }
    public function signinAction()
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

        if ($email && $password) {
            $token = LoginHandler::verifyLogin($email, $password);
            if ($token) {
                $_SESSION['token'] = $token;
                $this->redirect('/');
            } else {
                $_SESSION['flash'] = 'Email e/ou senha não conferem.';
                $this->redirect('/login');
            }
        } else {
            $_SESSION['flash'] = 'Digite os campos de email e/ou senha!';
            $this->redirect('/login');
        }
    }
    public function signup()
    {
        $flash = '';
        if (!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }
        $this->render('signup', ['flash' => $flash]);
    }
    public function signupAction()
    {
        $name = filter_input(INPUT_POST, 'name');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');
        $birthdate = filter_input(INPUT_POST, 'birthdate');

        if ($name && $email && $password && $birthdate) {
            $_SESSION['flash'] = '';
            if ($birthdate = LoginHandler::checkDate($birthdate, $_SESSION['flash'])) {
                if (LoginHandler::emailExists($email) === false) {
                    $token = LoginHandler::addUser($name, $email, $password, $birthdate);
                    $_SESSION['token'] = $token;
                    $this->redirect('/');
                } else {
                    $_SESSION['flash'] = 'Email já cadastrado!';
                    $this->redirect('/signup');
                }
            }
        } else {
            $this->redirect('/signup');
        }
    }
}
