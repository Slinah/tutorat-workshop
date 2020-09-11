<?php
require_once "../includes/functions.php";

$idSchool = filter_input(INPUT_POST, 'idDeleteSchool');

hpost('http://localhost:4567/api/deleteSchool', array('idSchool' => $idSchool));

header('location: /admin');
