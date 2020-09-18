<?php
require_once "../includes/functions.php";

$idPersonne = filter_input(INPUT_POST, 'id_personne');
$idMatiere = filter_input(INPUT_POST, 'id_matiere');
$idPromo = filter_input(INPUT_POST, "id_promo");
$intitule = filter_input(INPUT_POST, "intitule");
$commentaires = filter_input(INPUT_POST, "commentaires");
$date = filter_input(INPUT_POST, "date");
$heure = filter_input(INPUT_POST, "dateHeure");
$heure .= ":00";
$timeZone = new DateTimeZone("Europe/Paris");
$d = DateTime::createFromFormat('Y-m-d H:i:s', $date . " " . $heure);
$d = $d->format('Y-m-d H:i:s');
if ($d != null) {
    hpost("http://localhost:4567/api/postCourse", array("id_personne" => $idPersonne, "id_matiere" => $idMatiere, "id_promo" => $idPromo, "intitule" => $intitule,
        "date" => $d, "commentaires" => $commentaires));
}

header("Location: /cours#inSemaine");
