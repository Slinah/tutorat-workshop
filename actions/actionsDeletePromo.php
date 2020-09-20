<?php
require_once "../includes/functions.php";
session_start();

$idDeletePromo = filter_input(INPUT_POST, 'idDeletePromo', FILTER_SANITIZE_SPECIAL_CHARS);

$_SESSION['retourUser']=hpost('http://localhost:4567/api/deletePromo', array('idPromo' => $idDeletePromo));

header('location: /admin');
