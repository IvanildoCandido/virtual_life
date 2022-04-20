<?php

namespace src\handlers;

use \src\models\Post;
use \src\models\User;
use \src\models\User_Relation;

class PostHandler
{
    public static function addPost($idUser, $type, $body)
    {
        $body = trim($body);
        if (!empty($idUser) && !empty($body)) {
            Post::insert([
                'id_user' => $idUser,
                'type' => $type,
                'created_at' => date('Y-m-d H:i:s'),
                'body' => $body,
            ])->execute();
        }
    }
    public static function getHomeFeed($userId)
    {
        // Get list of users I follow
        $followUsers = User_Relation::select()
            ->where('user_from', $userId)->get();
        $users = [];
        foreach ($followUsers as $userFollow) {
            $users[] = $userFollow['user_to'];
        }
        $users[] = $userId;
    }
}
