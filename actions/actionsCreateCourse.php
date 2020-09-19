<?php
require_once "../includes/functions.php";

$idPersonne = filter_input(INPUT_POST, 'id_personne', FILTER_SANITIZE_SPECIAL_CHARS);
$idMatiere = filter_input(INPUT_POST, 'id_matiere', FILTER_SANITIZE_SPECIAL_CHARS);
$idPromo = filter_input(INPUT_POST, "id_promo", FILTER_SANITIZE_SPECIAL_CHARS);
$intitule = filter_input(INPUT_POST, "intitule", FILTER_SANITIZE_SPECIAL_CHARS);
$commentaires = filter_input(INPUT_POST, "commentaires", FILTER_SANITIZE_SPECIAL_CHARS);

$date = filter_input(INPUT_POST, "date", FILTER_SANITIZE_SPECIAL_CHARS);
$heure = filter_input(INPUT_POST, "heure", FILTER_SANITIZE_SPECIAL_CHARS);
$timeZone = new DateTimeZone("Europe/Paris");
$d = DateTime::createFromFormat(
    'd-m-Y H:i:s',
    $date . ' ' . $heure,
    $timeZone
);
$dateTimeStamp = $d->getTimestamp();

// fixme verif ici - changement avec la date
$idProposition = hpost("http://localhost:4567/api/postCourse", array("id_personne" => $idPersonne, "id_matiere" => $idMatiere, "id_promo" => $idPromo, "intitule" => $intitule, "date" => $dateTimeStamp, "commentaires" => $commentaires));

header("Location: http://workshop/cours#inSemaine");
