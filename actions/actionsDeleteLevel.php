<?php
require_once "../includes/functions.php";
session_start();

$idLevel = filter_input(INPUT_POST, 'idDeleteLevel');

$_SESSION['retourUser']=hpost("http://localhost:4567/api/deleteLevel", array('idLevel' => $idLevel));

header("location: /admin");
