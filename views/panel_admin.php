<?php

include_once "includes/composants/nav-bar.php";

//TODO à enlever quand la page de connexion sera dispo
$_SESSION["role"] = 1;

if (!isset($_SESSION["role"]) || ($_SESSION["role"] != 1)){
//    Redirigé sur une autre page
}
?>
<style>
    h1 {padding-top: 50px}
</style>
<h1>Panel d'administration</h1>


