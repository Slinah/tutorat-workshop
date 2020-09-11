<?php
require_once "../includes/functions.php";

$idLevel = filter_input(INPUT_POST, 'idDeleteLevel');

hpost("http://localhost:4567/api/deleteLevel", array('idLevel' => $idLevel));

header("location: /admin");
