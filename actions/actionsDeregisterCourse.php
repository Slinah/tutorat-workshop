<?php
require_once "../includes/functions.php";
$idPersonne = filter_input(INPUT_POST, 'idPersonne');
$idCours = filter_input(INPUT_POST, 'idCours');

hpost('http://localhost:4567/api/postDeregisterFromCourse', array("idPersonne" => $idPersonne, "idCours" => $idCours));

header("location: /workshop/profile");
