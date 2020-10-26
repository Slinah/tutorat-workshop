<?php

require_once "composants/header_options.php";
require_once "composants/footer_options.php";
require_once "Guard.php";


$request = $_SERVER['REQUEST_URI'];
$cursor = "cursor";
$dataUser = $_SESSION["me"];
if(property_exists((object)$dataUser, "id_personne")){
    $dataPref = hpost('http://localhost:4567/api/getPreferenceById', array('idPersonne' => $dataUser->id_personne));
    $curseurId=$dataPref[0]->curseur_id;
} else{
    $curseurId=0;
}

switch ($curseurId) {
    case 0:
        $cursor = "cursor";
        break;
    case 1:
        $cursor = "cursorLogoElephant";
        break;
    case 2:
        $cursor = "cursorScratch";
        break;
    case 3:
        $cursor = "cursorScratchBlue";
        break;
    case 4:
        $cursor = "cursorPoussin";
        break;
    case 5:
        $cursor = "cursorCerf";
        break;
    case 6:
        $cursor = "cursorPiaf";
        break;
    case 7:
        $cursor = "cursorPoulet";
        break;
    case 8:
        $cursor = "cursorBee";
        break;
    case 9:
        $cursor = "cursorVache";
        break;
    case 10:
        $cursor = "cursorElephant";
        break;
    case 200:
        $cursor = "cursorEpsi";
        break;
    case 201:
        $cursor = "cursorWis";
        break;
    case 202:
        $cursor = "cursorPumbaa";
        break;
    case 203:
        $cursor = "cursorBde";
        break;
    case 400:
        $cursor = "cursorScratchRainbow";
        break;
    case 401:
        $cursor = "cursorSpider";
        break;
    case 402:
        $cursor = "cursorHalloween";
        break;
    case 600:
        $cursor = "cursorPriscillia";
        break;
    case 601:
        $cursor = "cursorCedric";
        break;
    case 602:
        $cursor = "cursorLelito";
        break;
    case 603:
        $cursor = "cursorMayon";
        break;
    case 604:
        $cursor = "cursorMathis";
        break;
    case 605:
        $cursor = "cursorBreval";
        break;
    case 606:
        $cursor = "cursorAndy";
        break;
    case 666:
        $cursor = "cursorOberi";
        break;
}

switch ($request) {
    case (preg_match('/\/\?fbclid=/', $request) ? true : false):
    case '':
    case '/' :
        header_options(["style", "nav", "button", "card",$cursor]);
        require 'views/maintenance.php';
        footer_options(["lottie", "navBtn", "fonction"]);
        break;
    case '/cours' :
        HaveToBeConnected();
        header_options(["style", "nav", "button", "card", "cardCours",$cursor]);
        //require 'views/courses.php';
        require 'views/maintenance.php';
        footer_options(["lottie", "navBtn", "fonction"]);
        break;
    case '/donner-cours' :
        HaveToBeConnected();
        header_options(["style", "nav", "button", "formCours",$cursor]);
        //require 'views/createCourses.php';
        require 'views/maintenance.php';
        footer_options(["lottie", "navBtn", "fonction"]);
        break;
    case '/suggestion-cours' :
        HaveToBeConnected();
        header_options(["style", "nav", "button", "formCours",$cursor]);
        //require 'views/askForCourses.php';
        require 'views/maintenance.php';
        footer_options(["lottie", "navBtn", "fonction"]);
        break;
    case '/suggestion-liste':
        HaveToBeConnected();
        header_options(["style", "nav", "button", "card", "cardCours",$cursor]);
        //require 'views/listSuggestions.php';
        require 'views/maintenance.php';
        footer_options(["lottie", "navBtn", "fonction"]);
        break;
    case '/tuteur-cours':
        HaveToBeConnected();
        header_options(["style", "nav", "button", "card", "formAdminCours", "modal",$cursor]);
        //require 'views/adminCours.php';
        require 'views/maintenance.php';
        footer_options(["lottie", "navBtn", "jquery", "fonction", "tuteurCours"]);
        break;
    case '/creer-matiere':
        HaveToBeConnected();
        header_options(["style", "nav", "button", "card", "formAdminCours",$cursor]);
        //require 'views/createMatiere.php';
        require 'views/maintenance.php';
        footer_options(["lottie", "navBtn", "fonction", "adminCours"]);
        break;
    case '/forum' :
        header_options(["style", "nav", "button", "card", "cardForum",$cursor]);
        //require 'views/forum.php';
        require 'views/maintenance.php';
        footer_options(["lottie", "navBtn", "fonction"]);
        break;
    case '/admin' :
        HaveToBeAdmin();
        header_options(["style", "nav", "button", "card", "formAdmin",$cursor]);
        //require 'views/panel_admin.php';
        require 'views/maintenance.php';
        footer_options(["jquery", "panel_admin", "lottie", "navBtn", "fonction"]);
        break;
    case '/profile' :
        HaveToBeConnected();
        header_options(["style", "nav", "button", "card", "profil",$cursor]);
        //require 'views/profile.php';
        require 'views/maintenance.php';
        footer_options(["jquery", "lottie", "navBtn", "profile"]);
        break;
    case '/forum/create' :
        HaveToBeConnected();
        header_options(["style", "nav", "button", "formForumCreate",$cursor]);
        //require 'views/forum_create.php';
        require 'views/maintenance.php';
        footer_options(["lottie", "navBtn", "fonction"]);
        break;
    case (preg_match('/\/forum\/./', $request) ? true : false) :
        header_options(["style", "nav", "button", "card", "cardSujetForum", "modal",$cursor]);
        //require 'views/forum_question.php';
        require 'views/maintenance.php';
        footer_options(["lottie", "navBtn", "fonction", "forum"]);
        break;
    case '/connexion' :
        HaveToBeNOTConnected();
        header_options(["style", "nav", "button", "form",$cursor]);
        //require 'views/connexion.php';
        require 'views/maintenance.php';
        footer_options(["lottie", "navBtn", "fonction", "connexionSubmitFormEnter"]);
        break;
    case '/register' :
        HaveToBeNOTConnected();
        header_options(["style", "nav", "button", "form",$cursor]);
        //require 'views/register.php';
        require 'views/maintenance.php';
        footer_options(["jquery", "register", "fonction", "registerSubmitFormEnter"]);
        break;
    case '/dc':
        Destroy();
        //header('location: /connexion');
        require 'views/maintenance.php';
        break;
    default:
        header_options(["style", "404", "nav", "button",$cursor]);
        http_response_code(404);
        require 'views/404.php';
        break;
}
