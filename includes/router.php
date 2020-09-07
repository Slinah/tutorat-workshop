<?php

require_once "composants/header_options.php";

// Mise en place du router :

$request = $_SERVER['REQUEST_URI'];  // recuperer l'url demandée par le client
//var_dump($request);
switch ($request) {  // Selectionée le body de la page en fonction
    case '':
    case '/' :
        header_options(["style"]);
        require 'views/home.php';     // les url "http://https://scratchoverflow.fr" et
        // "http://https://scratchoverflow.fr/" vont cherche le contenue
        // de /views/home.php
        break;

    case '/about' : // ne pas oublier le "/" devant le chemin
        header_options(["style"]);
        require 'views/about.php';   // Exemple pour une potentiel page about
        break;
    case '/forum' : // ne pas oublier le "/" devant le chemin
        header_options(["style", "forum"]);
        require 'views/forum.php';   // Exemple pour une potentiel page about
        break;
    case '/forum/create' : // ne pas oublier le "/" devant le chemin
        header_options(["style", "forum"]);
        require 'views/forum_create.php';   // Exemple pour une potentiel page about
        break;
    default:
        header_options(["style", "404"]);
        http_response_code(404);  // par defaut (comprendre : si le chemin ne correspond a aucune des route precedement definie)
        require 'views/404.php'; // Rediriger vers une erreur 404 (avec un contenue custom)
        break;
}
