<?php
require_once "../includes/functions.php";
session_start();

$idDeleteClass = filter_input(INPUT_POST, 'idDeleteClasse', FILTER_SANITIZE_SPECIAL_CHARS);

$_SESSION['retourUser']=hpost('http://localhost:4567/api/deleteClass', array('idClass' => $idDeleteClass));

header('location: /admin');
