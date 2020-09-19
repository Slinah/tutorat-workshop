<?php
require_once "../includes/functions.php";

$idSchool = filter_input(INPUT_POST, 'idSchool,', FILTER_SANITIZE_SPECIAL_CHARS);
$intitulePromo = filter_input(INPUT_POST, 'addPromo', FILTER_SANITIZE_SPECIAL_CHARS);

hpost('http://localhost:4567/api/addPromo', array('idSchool' => $idSchool, 'intitule' => $intitulePromo));

header('location: /admin');
