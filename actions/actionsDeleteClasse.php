<?php
require_once "../includes/functions.php";

$idDeleteClass = filter_input(INPUT_POST, 'idDeleteClasse', FILTER_SANITIZE_SPECIAL_CHARS);


hpost('http://localhost:4567/api/deleteClass', array('idClass' => $idDeleteClass));

header('location: /admin');
