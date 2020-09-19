<?php
require_once "../includes/functions.php";

$intituleSchool = filter_input(INPUT_POST, 'addSchool', FILTER_SANITIZE_SPECIAL_CHARS);

hpost('http://localhost:4567/api/addSchool', array('intitule' => $intituleSchool));

header('location: /admin');
