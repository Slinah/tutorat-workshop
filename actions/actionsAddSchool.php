<?php
require_once "../includes/functions.php";

$intituleSchool = filter_input(INPUT_POST, 'addSchool');

hpost('http://localhost:4567/api/addSchool', array('intitule' => $intituleSchool));

header('location: /admin');
