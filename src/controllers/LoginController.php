<?php

namespace src\controllers;

use \core\Controller;

class LoginController extends Controller
{

    public function signin()
    {
        $this->render('login');
    }
    public function signinAction()
    {
        echo 'login Recebido';
    }
    public function signup()
    {
        echo 'cadastro';
    }
}
