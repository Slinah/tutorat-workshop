<?php
require_once "../includes/functions.php";
session_start();

$idDeleteSubject = filter_input(INPUT_POST, 'idDeleteSubject');

$_SESSION['retourUser']=hpost('http://localhost:4567/api/deleteSubject', array('idSubject' => $idDeleteSubject));

header('location: /admin');
