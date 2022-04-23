<?php

namespace src\controllers;

use \core\Controller;
use \src\handlers\UserHandler;
use \src\models\User;

class ProfileController extends Controller
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
        $id = $this->loggedUser->getId();
        if (!empty($args['id'])) {
            $id = $args['id'];
        }
        $user = UserHandler::idExists($id, true);

        if (!$user) {
            $this->redirect('/');
        }

        $age = User::getAge($user->getBirthdate());

        $this->render('profile', [
            'loggedUser' => $this->loggedUser,
            'user' => $user,
            'age' => $age
        ]);
    }
}
