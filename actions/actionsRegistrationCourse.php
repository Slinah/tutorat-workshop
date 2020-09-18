<?php
require_once "../includes/functions.php";

$idPersonne = filter_input(INPUT_POST, 'id_personne');
$idCours = filter_input(INPUT_POST, 'id_cours');

hpost("http://localhost:4567/api/registrationCourse", array("idPeople" => $idPersonne, "idCourse" => $idCours));
header("Location: /cours#inSemaine");
