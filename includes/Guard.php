<?php

if (!array_key_exists("me", $_SESSION)) {
    $_SESSION["me"] = new stdClass();
    $_SESSION["me"]->token = "";
}

function HaveToBeConnected()
{
    if (!hpost("http://localhost:4567/api/isConnected", array("token" => $_SESSION["me"]->token))->check /* token existe ? oui / non */) {
        header("Location: /connexion");
    }
}

function HaveToBeAdmin()
{
    if (!hpost("http://localhost:4567/api/isAdmin", array("token" => $_SESSION["me"]->token))->admin) {
        header("Location: /");
    }
}

function HaveToBeNOTConnected()
{

    if ($_SESSION["me"]->token != "") {
        header("Location: /");
    }

}

function Destroy()
{
    session_unset();
    session_destroy();
    header("Location: /");

}


