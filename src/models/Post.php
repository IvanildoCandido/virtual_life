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
    private $mySelf;
    private $likesCount = 0;
    private $comments = [];
    private $liked = false;


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
    public function getMySelf()
    {
        return $this->mySelf;
    }

    public function setMySelf($mySelf)
    {
        return $this->mySelf = $mySelf;
    }
    public function getLikesCount()
    {
        return $this->likesCount;
    }

    public function setLikesCount($likesCount)
    {
        return $this->likesCount = $likesCount;
    }
    public function getComments()
    {
        return $this->comments;
    }

    public function setComments($comments)
    {
        return $this->comments = $comments;
    }
    public function getLiked()
    {
        return $this->liked;
    }

    public function setLiked($liked)
    {
        return $this->liked = $liked;
    }
}
