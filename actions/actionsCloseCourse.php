<?php
require_once "../includes/functions.php";
session_start();

$coursIntitule = filter_input(INPUT_POST, 'coursIntitule');
$matiereIntitule = filter_input(INPUT_POST, 'matiereIntitule');
$commentaires = filter_input(INPUT_POST, "commentaires");
$promoIntitule = filter_input(INPUT_POST,"promoIntitule");
$nbParticipants = filter_input(INPUT_POST, 'nbParticipants');
$duree = filter_input(INPUT_POST, 'duree');
$salle = filter_input(INPUT_POST, "salle");
$id_cours = filter_input(INPUT_POST,"id_cours");
$id_personne = filter_input(INPUT_POST,"id_personne");
$id_matiere = filter_input(INPUT_POST,"id_matiere");
$id_promo = filter_input(INPUT_POST,"id_promo");
$status = filter_input(INPUT_POST,"status");
$date = filter_input(INPUT_POST,"date");
$dateHeure = filter_input(INPUT_POST,"dateHeure");

$timeZone = new DateTimeZone("Europe/Paris");
$d = DateTime::createFromFormat('Y-m-d H:i:s', $date.' '.$dateHeure, $timeZone);
if ($d != false){
    $dateTimeStamp = $d->getTimestamp();

    $all=[$coursIntitule,$matiereIntitule,$commentaires,$promoIntitule,$nbParticipants,
        $duree,$salle,$id_cours,$id_personne,$id_matiere,$id_promo,$status,$date,
        $dateHeure, $dateTimeStamp, $timeZone, $d];
    var_dump($all);
} else{
    header('location: /tuteur-cours');
}
// todo faire le fonctionnement de cloture de cours
