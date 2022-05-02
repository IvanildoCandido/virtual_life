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
        $avatar = $this->loggedUser->getAvatar();
        $cover = $this->loggedUser->getCover();

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
        // Avatar
        if (isset($_FILES['avatar']) && !empty($_FILES['avatar']['tmp_name'])) {
            if (in_array($_FILES['avatar']['type'], ['image/jpg', 'image/jpeg', 'image/png'])) {
                $avatarName = $this->cutImage($_FILES['avatar'], 200, 200, 'media/avatars');
                $avatar = $avatarName;
            }
        }
        // Cover
        if (isset($_FILES['cover']) && !empty($_FILES['cover']['tmp_name'])) {
            if (in_array($_FILES['cover']['type'], ['image/jpg', 'image/jpeg', 'image/png'])) {
                $coverName = $this->cutImage($_FILES['cover'], 850, 310, 'media/covers');
                $cover = $coverName;
            }
        }
        User::update()
            ->set('name', $name)
            ->set('email', $email)
            ->set('city', $city)
            ->set('work', $work)
            ->set('birthdate', $birthdate)
            ->set('avatar', $avatar)
            ->set('cover', $cover)
            ->where('id', $this->loggedUser->getId())
            ->execute();
        $this->redirect('/config');
    }
    public function cutImage($file, $width, $height, $folder)
    {
        list($widthOri, $heightOri) = getimagesize($file['tmp_name']);
        $ratio = $widthOri / $heightOri;
        $newWidth = $width;
        $newHeight = $newWidth / $ratio;
        if ($newHeight < $height) {
            $newHeight = $height;
            $newWidth = $newHeight * $ratio;
        }
        $x = $width - $newWidth;
        $y = $height - $newHeight;
        $x = $x < 0 ? $x / 2 : $x;
        $y = $y < 0 ? $y / 2 : $y;
        $finalImage = imagecreatetruecolor($width, $height);
        switch ($file['type']) {
            case 'image/jpeg':
            case 'image/jpg':
                $image = imagecreatefromjpeg($file['tmp_name']);
                break;
            case 'image/png':
                $image = imagecreatefrompng($file['tmp_name']);
                break;
        }
        imagecopyresampled($finalImage, $image, $x, $y, 0, 0, $newWidth, $newHeight, $widthOri, $heightOri);
        $fileName = md5(time() . rand(0, 9999)) . '.jpg';
        imagejpeg($finalImage, $folder . '/' . $fileName);
        return $fileName;
    }
}
