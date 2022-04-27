<?php

namespace src\controllers;

use \core\Controller;
use \src\handlers\UserHandler;
use \src\models\User;

class SearchController extends Controller
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
        $search = filter_input(INPUT_GET, 's');

        if (empty($search)) {
            $this->redirect('/');
        }
        $users = UserHandler::searchUsers($search);

        $this->render('search', [
            'loggedUser' => $this->loggedUser,
            'search' => $search,
            'users' => $users,
        ]);
    }
}
