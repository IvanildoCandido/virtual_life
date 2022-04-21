<?php

namespace src\controllers;

use \core\Controller;
use \src\handlers\UserHandler;

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
        $user = UserHandler::idExists($id);

        if (!$user) {
            $this->redirect('/');
        }

        $this->render('profile', [
            'loggedUser' => $this->loggedUser,
            'user' => $user
        ]);
    }
}
