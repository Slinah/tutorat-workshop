<?php
require_once "../includes/functions.php";

$idUser = filter_input(INPUT_POST, 'idUser');

hpost('http://localhost:4567/api/promoteAdmin', array('idPersonne' => $idUser));

header('location: /admin');
