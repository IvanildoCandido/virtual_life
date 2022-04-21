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
    public static function getHomeFeed($userId, $page)
    {
        $perPage = 2;
        // Get list of users I follow
        $followUsers = User_Relation::select()
            ->where('user_from', $userId)->get();
        $users = [];
        foreach ($followUsers as $userFollow) {
            $users[] = $userFollow['user_to'];
        }
        $users[] = $userId;
        // Get posts sorted by date
        $postsList = Post::select()
            ->where('id_user', 'in', $users)
            ->orderBy('created_at', 'desc')
            ->page($page, $perPage)
            ->get();
        //Pagination
        $pagesCount = ceil((Post::select()
            ->where('id_user', 'in', $users)
            ->count() / $perPage));
        // Convert result into objects
        $posts = [];
        foreach ($postsList as $postItem) {
            $post = new Post();
            $user = User::select()->where('id', $postItem['id_user'])->one();
            $post->setId($postItem['id']);
            $post->setType($postItem['type']);
            $post->setCreated_at($postItem['created_at']);
            $post->setBody($postItem['body']);
            $post->setMySelf(false);

            if ($postItem['id_user'] === $userId) {
                $post->setMySelf(true);
            }

            $post->user = new User();
            $post->user->setId($user['id']);
            $post->user->setName($user['name']);
            $post->user->setAvatar($user['avatar']);

            $posts[] = $post;
        }

        return [
            'posts' => $posts,
            'currentPage' => $page,
            'pagesCount' => $pagesCount
        ];
    }
}
