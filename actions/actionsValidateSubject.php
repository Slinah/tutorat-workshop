<?php
require_once "../includes/functions.php";
session_start();

$idSubject = filter_input(INPUT_POST, 'idValidateSubject', FILTER_SANITIZE_SPECIAL_CHARS);

$_SESSION['retourUser']=hpost('http://localhost:4567/api/validateSubject', array('idSubject' => $idSubject));

header('location: /admin');
