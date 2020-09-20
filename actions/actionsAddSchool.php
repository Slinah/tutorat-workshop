<?php
require_once "../includes/functions.php";
session_start();

$intituleSchool = filter_input(INPUT_POST, 'addSchool', FILTER_SANITIZE_SPECIAL_CHARS);

$_SESSION['retourUser']=hpost('http://localhost:4567/api/addSchool', array('intitule' => $intituleSchool));

header('location: /admin');
