<?php

namespace src\models;

use \core\Model;

class Post extends Model
{
    private $id;
    private $id_user;
    private $type;
    private $created_at;
    private $body;


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        return $this->id = $id;
    }

    public function getId_user()
    {
        return $this->id_user;
    }

    public function setId_user($id_user)
    {
        return $this->id_user = $id_user;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        return $this->type = $type;
    }

    public function getCreated_at()
    {
        return $this->created_at;
    }

    public function setCreated_at($created_at)
    {
        return $this->created_at = $created_at;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setBody($body)
    {
        return $this->body = $body;
    }
}
