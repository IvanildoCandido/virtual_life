<?php

namespace src\models;

use \core\Model;

class User extends Model
{
    private $id;
    private $email;
    private $password;
    private $name;
    private $birthdate;
    private $city;
    private $work;
    private $avatar;
    private $cover;
    private $token;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        return $this->id = $id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        return $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        return $this->password = $password;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        return $this->name = $name;
    }

    public function getBirthdate()
    {
        return $this->birthdate;
    }

    public function setBirthdate($birthdate)
    {
        return $this->birthdate = $birthdate;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        return $this->city = $city;
    }

    public function getWork()
    {
        return $this->work;
    }

    public function setWork($work)
    {
        return $this->work = $work;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function setAvatar($avatar)
    {
        return $this->avatar = $avatar;
    }

    public function getCover()
    {
        return $this->cover;
    }

    public function setCover($cover)
    {
        return $this->cover = $cover;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function setToken($token)
    {
        return $this->token = $token;
    }
}
