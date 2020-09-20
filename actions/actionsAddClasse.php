<?php
require_once "../includes/functions.php";
session_start();

$idPromo = filter_input(INPUT_POST, 'idPromo');
$intituleClasse = filter_input(INPUT_POST, 'addClasse');

$_SESSION['retourUser']=hpost('http://localhost:4567/api/addClass', array('idPromo' => $idPromo, 'intitule' => $intituleClasse));

header('location: /admin');
