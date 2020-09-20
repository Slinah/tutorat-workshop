<?php
require_once "../includes/functions.php";
session_start();

$intituleLevel = filter_input(INPUT_POST, 'addLevel', FILTER_SANITIZE_SPECIAL_CHARS);

$_SESSION['retourUser']=hpost("http://localhost:4567/api/addLevel", array('intitule' => $intituleLevel));

header("location: /admin");
