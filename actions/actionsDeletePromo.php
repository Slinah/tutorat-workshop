<?php
require_once "../includes/functions.php";

$idDeletePromo = filter_input(INPUT_POST, 'idDeletePromo');


hpost('http://localhost:4567/api/deletePromo', array('idPromo' => $idDeletePromo));

header('location: /admin');
