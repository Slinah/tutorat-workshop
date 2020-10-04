<?php
require_once "../includes/functions.php";
session_start();
//todo gestion des retours ?

$idUser = filter_input(INPUT_POST, 'idUser', FILTER_SANITIZE_SPECIAL_CHARS);

$_SESSION['retourUser']=hpost('http://localhost:4567/api/promoteAdmin', array('idPersonne' => $idUser));

header('location: /admin');
