<?php

namespace src\handlers;

use \src\models\Post;
use \src\models\User;
use \src\models\Post_Like;
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
    public static function _postListToObject($postsList, $loggedUserId)
    {
        $posts = [];
        foreach ($postsList as $postItem) {
            $post = new Post();
            $user = User::select()->where('id', $postItem['id_user'])->one();
            $post->setId($postItem['id']);
            $post->setType($postItem['type']);
            $post->setCreated_at($postItem['created_at']);
            $post->setBody($postItem['body']);
            $post->setMySelf(false);

            if ($postItem['id_user'] === $loggedUserId) {
                $post->setMySelf(true);
            }

            $post->user = new User();
            $post->user->setId($user['id']);
            $post->user->setName($user['name']);
            $post->user->setAvatar($user['avatar']);

            // Informações de likes
            $likes = Post_Like::select()
                ->where('id_post', $postItem['id'])
                ->get();
            $mylike = Post_Like::select()
                ->where('id_post', $postItem['id'])
                ->where('id_user', $loggedUserId)
                ->get();
            $post->setlikesCount(count($likes));
            $post->setLiked((count($mylike) > 0) ? true : false);


            $posts[] = $post;
        }
        return $posts;
    }
    public static function getUserFeed($userId, $page, $loggedUserId)
    {
        $perPage = 2;
        // Get posts sorted by date
        $postsList = Post::select()
            ->where('id_user', $userId)
            ->orderBy('created_at', 'desc')
            ->page($page, $perPage)
            ->get();
        //Pagination
        $pagesCount = ceil((Post::select()
            ->where('id_user', $userId)
            ->count() / $perPage));
        // Convert result into objects
        $posts = self::_postListToObject($postsList, $loggedUserId);

        return [
            'posts' => $posts,
            'currentPage' => $page,
            'pagesCount' => $pagesCount
        ];
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
        $posts = self::_postListToObject($postsList, $userId);

        return [
            'posts' => $posts,
            'currentPage' => $page,
            'pagesCount' => $pagesCount
        ];
    }
    public static function getPhotosFrom($id)
    {
        $data = Post::select()
            ->where('id_user', $id)
            ->where('type', 'photo')
            ->get();

        $photos = [];

        foreach ($data as $photo) {
            $post = new Post();
            $post->setId($photo['id']);
            $post->setType($photo['type']);
            $post->setCreated_at($photo['created_at']);
            $post->setBody($photo['body']);
            $photos[] = $post;
        }
        return $photos;
    }
}
