<?php
require_once "../includes/functions.php";
session_start();

$idUser = filter_input(INPUT_POST, 'idUser', FILTER_SANITIZE_SPECIAL_CHARS);

$_SESSION['retourUser']=hpost('http://localhost:4567/api/deleteAccount', array('idPersonne' => $idUser));

header('location: /admin');
