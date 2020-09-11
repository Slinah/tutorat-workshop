<?php
require_once "../includes/functions.php";

$intituleLevel = filter_input(INPUT_POST, 'addLevel');

hpost("http://localhost:4567/api/addLevel", array('intitule' => $intituleLevel));

header("location: /admin");
