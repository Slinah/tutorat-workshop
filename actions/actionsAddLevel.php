<?php
require_once "../includes/functions.php";
session_start();

$intituleLevel = filter_input(INPUT_POST, 'addLevel');

$_SESSION['retourUser']=hpost("http://localhost:4567/api/addLevel", array('intitule' => $intituleLevel));

header("location: /admin");
