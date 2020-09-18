<?php
require_once "../includes/functions.php";

$idPersonne = filter_input(INPUT_POST, 'id_personne');
$idMatiere = filter_input(INPUT_POST, 'id_matiere');
$idPromo = filter_input(INPUT_POST, "id_promo");
$intitule = filter_input(INPUT_POST,"intitule");
$commentaires = filter_input(INPUT_POST, "commentaires");
$date = filter_input(INPUT_POST,"date");
$heure = filter_input(INPUT_POST,"heure");
$timeZone = new DateTimeZone("Europe/Paris");
$d = DateTime::createFromFormat(
    'd-m-Y H:i:s',
    $date.' '.$heure,
    $timeZone
);
$dateTimeStamp = $d->getTimestamp();

// fixme verif ici - changement avec la date
hpost("http://localhost:4567/api/postCourse", array("id_personne"=>$idPersonne,"id_matiere"=>$idMatiere, "id_promo"=>$idPromo,"intitule"=>$intitule,
    "date"=>$dateTimeStamp, "commentaires"=>$commentaires));

header("Location: http://workshop/cours#inSemaine");
