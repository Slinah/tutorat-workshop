<?php

require_once "composants/header_options.php";


$request = $_SERVER['REQUEST_URI'];
switch ($request) {
    case '':
    case '/' :
        header_options(["style"]);
        require 'views/home.php';
        break;
    case '/about' :
        header_options(["style"]);
        require 'views/about.php';
        break;
    case '/forum' :
        header_options(["style", "forum"]);
        require 'views/forum.php';
        break;
    case '/forum/create' :
        header_options(["style", "forum"]);
        require 'views/forum_create.php';
        break;
    case (preg_match('/\/forum\/./', $request) ? true : false) :
        header_options(["style", "forum"]);
        require 'views/forum_question.php';
        break;
    default:
        header_options(["style", "404"]);
        http_response_code(404);
        require 'views/404.php';
        break;
}
