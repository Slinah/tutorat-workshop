<?php

require_once "composants/header_options.php";


$request = $_SERVER['REQUEST_URI'];
switch ($request) {
    case '':
    case '/' :
        header_options(["style", "nav", "button"]);
        require 'views/home.php';
        break;
    case '/about' :
        header_options(["style", "nav", "button"]);
        require 'views/about.php';
        break;
    case '/forum' :
        header_options(["style", "nav", "button", "card", "cardForum"]);
        require 'views/forum.php';
        break;
    case '/admin' :
        header_options(["style", "nav", "button", "card"]);
        require 'views/panel_admin.php';
        break;
    case '/forum/create' :
        header_options(["style", "forum", "nav", "button"]);
        require 'views/forum_create.php';
        break;
    case (preg_match('/\/forum\/./', $request) ? true : false) :
        header_options(["style", "forum", "nav", "button"]);
        require 'views/forum_question.php';
        break;
    default:
        header_options(["style", "404", "nav", "button"]);
        http_response_code(404);
        require 'views/404.php';
        break;
}
