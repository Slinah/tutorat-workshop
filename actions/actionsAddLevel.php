<?php
require_once "../includes/functions.php";

$intituleLevel = filter_input(INPUT_POST, 'addLevel', FILTER_SANITIZE_SPECIAL_CHARS);

hpost("http://localhost:4567/api/addLevel", array('intitule' => $intituleLevel));

header("location: /admin");
