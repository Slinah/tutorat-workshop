<?php
require_once "../includes/functions.php";

$idUser = filter_input(INPUT_POST, 'idUser', FILTER_SANITIZE_SPECIAL_CHARS);

hpost('http://localhost:4567/api/deleteAccount', array('idPersonne' => $idUser));

header('location: /admin');
