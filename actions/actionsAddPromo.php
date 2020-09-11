<?php
require_once "../includes/functions.php";

$idSchool = filter_input(INPUT_POST, 'idSchool');
$intitulePromo = filter_input(INPUT_POST, 'addPromo');

hpost('http://localhost:4567/api/addPromo', array('idSchool' => $idSchool, 'intitule' => $intitulePromo));

header('location: /admin');
