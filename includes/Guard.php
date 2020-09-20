<?php

if (!array_key_exists("me", $_SESSION)) {
    $_SESSION["me"] = new stdClass();
    $_SESSION["me"]->token = "";
}

function HaveToBeConnected()
{
// var_dump(hpost("http://localhost:4567/api/isConnected", array("token" => $_SESSION["token"])));
    if (!hpost("http://localhost:4567/api/isConnected", array("token" => $_SESSION["me"]->token))->check /* token existe ? oui / non */) {
        header("Location: /connexion");
//        echo "Guard Activer ! Redirect";
    }
//    var_dump($_SESSION["me"]->token);
}

function HaveToBeAdmin()
{
// var_dump(hpost("http://localhost:4567/api/isAdmin", array("token" => $_SESSION["token"])));
    if (!hpost("http://localhost:4567/api/isAdmin", array("token" => $_SESSION["me"]->token))->admin) {
//        echo "Guard Activer ! Redirect";
        header("Location: /");
    }
}

function HaveToBeNOTConnected()
{
// var_dump(hpost("http://localhost:4567/api/isConnected", array("token" => $_SESSION["token"])));
    if ( $_SESSION["me"]->token != "") {
//        echo "token ==  ";
        header("Location: /");
    }
//    echo "token !=  ";
//    var_dump($_SESSION["me"]->token);
}

function Destroy()
{
    session_unset();
    session_destroy();
    header("Location: /");

}


