<?php


include "includes/header.php";  // Recup le header







// Mise en place du router :

$request = $_SERVER['REQUEST_URI'];  // recuperer l'url demandée par le client
switch ($request) {  // Selectionée le body de la page en fonction
    case '':
    case '/' :
        require __DIR__ . '/views/home.php';     // les url "http://https://scratchoverflow.fr" et
                                                // "http://https://scratchoverflow.fr/" vont cherche le contenue
                                                // de /views/home.php
        break;

    case '/about' : // ne pas oublier le "/" devant le chemin
        require __DIR__ . '/views/about.php';   // Exemple pour une potentiel page about
        break;
    default:
        http_response_code(404);  // par defaut (comprendre : si le chemin ne correspond a aucune des route precedement definie)
        require __DIR__ . '/views/404.php'; // Rediriger vers une erreur 404 (avec un contenue custom)
        break;
}








include "includes/footer.php"; // Recup le footer