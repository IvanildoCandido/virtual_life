<?php

use core\Router;
use src\controllers\ProfileController;

$router = new Router();

$router->get('/', 'HomeController@index');
$router->get('/login', 'LoginController@signin');
$router->post('/login', 'LoginController@signinAction');

$router->get('/signup', 'LoginController@signup');
$router->post('/signup', 'LoginController@signupAction');

$router->get('/profile/{id}/photos', 'ProfileController@photos');
$router->get('/profile/{id}/friends', 'ProfileController@friends');
$router->get('/profile/{id}/follow', 'ProfileController@follow');
$router->get('/profile/{id}', 'ProfileController@index');
$router->get('/profile', 'ProfileController@index');

$router->get('/friends', 'ProfileController@friends');
$router->get('/photos', 'ProfileController@photos');



$router->post('/post/new', 'PostController@newPost');

$router->get('/logout', 'LoginController@logout');
