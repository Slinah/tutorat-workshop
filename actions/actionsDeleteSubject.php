<?php
require_once "../includes/functions.php";
session_start();

$idDeleteSubject = filter_input(INPUT_POST, 'idDeleteSubject', FILTER_SANITIZE_SPECIAL_CHARS);

$_SESSION['retourUser']=hpost('http://localhost:4567/api/deleteSubject', array('idSubject' => $idDeleteSubject));

header('location: /admin');
