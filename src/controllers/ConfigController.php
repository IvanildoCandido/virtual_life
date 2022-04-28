<?php

namespace src\controllers;

use \core\Controller;
use src\handlers\PostHandler;
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

        $this->render('config', [
            'loggedUser' => $this->loggedUser,
        ]);
    }
    public function follow($args)
    {
        $to =  $args['id'];
        $exists = UserHandler::idExists($to, false, true);
        if ($exists) {
            if (UserHandler::isFollowing($this->loggedUser->getId(), $to)) {
                UserHandler::unfollow($this->loggedUser->getId(), $to);
            } else {
                UserHandler::follow($this->loggedUser->getId(), $to);
            }
        }
        $this->redirect('/profile/' . $to);
    }
    public function friends($args = [])
    {
        //Detect user
        $id = $this->loggedUser->getId();
        if (!empty($args['id'])) {
            $id = $args['id'];
        }
        // Get user info
        $user = UserHandler::idExists($id, true);

        if (!$user) {
            $this->redirect('/');
        }
        // Verify if I following the user
        $isFollowing = false;
        if ($user->getId() !== $this->loggedUser->getId()) {
            $isFollowing = UserHandler::isFollowing($this->loggedUser->getId(), $user->getId());
        }

        $this->render('profile_friends', [
            'loggedUser' => $this->loggedUser,
            'user' => $user,
            'isFollowing' => $isFollowing
        ]);
    }
    public function photos($args = [])
    {
        //Detect user
        $id = $this->loggedUser->getId();
        if (!empty($args['id'])) {
            $id = $args['id'];
        }
        // Get user info
        $user = UserHandler::idExists($id, true);

        if (!$user) {
            $this->redirect('/');
        }
        // Verify if I following the user
        $isFollowing = false;
        if ($user->getId() !== $this->loggedUser->getId()) {
            $isFollowing = UserHandler::isFollowing($this->loggedUser->getId(), $user->getId());
        }

        $this->render('profile_photos', [
            'loggedUser' => $this->loggedUser,
            'user' => $user,
            'isFollowing' => $isFollowing
        ]);
    }
}
