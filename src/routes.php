<?php

use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');
$router->get('/login', 'LoginController@signin');
$router->post('/login', 'LoginController@signinAction');

$router->get('/signup', 'LoginController@signup');
$router->post('/signup', 'LoginController@signupAction');

$router->get('/profile/{id}', 'ProfileController@index');
$router->get('/profile', 'ProfileController@index');

$router->post('/post/new', 'PostController@newPost');

$router->get('/logout', 'LoginController@logout');
