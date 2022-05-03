<?php

namespace src\models;

use \core\Model;

class PostLike extends Model
{
    private $id;
    private $id_post;
    private $id_user;
    private $created_at;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        return $this->id = $id;
    }

    public function getId_post()
    {
        return $this->id_post;
    }

    public function setId_post($id_post)
    {
        return $this->id_post = $id_post;
    }

    public function getId_user()
    {
        return $this->id_user;
    }

    public function setId_user($id_user)
    {
        return $this->id_user = $id_user;
    }

    public function getCreated_at()
    {
        return $this->created_at;
    }

    public function setCreated_at($created_at)
    {
        return $this->created_at = $created_at;
    }
}
