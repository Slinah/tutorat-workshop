<?php
require_once "../includes/functions.php";

$idSchool = filter_input(INPUT_POST, 'idDeleteSchool', FILTER_SANITIZE_SPECIAL_CHARS);

hpost('http://localhost:4567/api/deleteSchool', array('idSchool' => $idSchool));

header('location: /admin');
