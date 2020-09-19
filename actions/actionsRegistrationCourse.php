<?php
require_once "../includes/functions.php";

$idPersonne = filter_input(INPUT_POST, 'id_personne', FILTER_SANITIZE_SPECIAL_CHARS);
$idCours = filter_input(INPUT_POST, 'id_cours', FILTER_SANITIZE_SPECIAL_CHARS);

hpost("http://localhost:4567/api/registrationCourse", array("idPeople" => $idPersonne, "idCourse" => $idCours));
header("Location: http://workshop/cours#inSemaine");
