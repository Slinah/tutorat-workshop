<?php
require_once "../includes/functions.php";
session_start();

$coursIntitule = filter_input(INPUT_POST, 'coursIntitule', FILTER_SANITIZE_SPECIAL_CHARS);
$matiereIntitule = filter_input(INPUT_POST, 'matiereIntitule', FILTER_SANITIZE_SPECIAL_CHARS);
$commentaires = filter_input(INPUT_POST, "commentaires", FILTER_SANITIZE_SPECIAL_CHARS);
$promoIntitule = filter_input(INPUT_POST, "promoIntitule", FILTER_SANITIZE_SPECIAL_CHARS);
$nbParticipants = filter_input(INPUT_POST, 'nbParticipants', FILTER_SANITIZE_SPECIAL_CHARS);
$duree = filter_input(INPUT_POST, 'duree', FILTER_SANITIZE_SPECIAL_CHARS);
$salle = filter_input(INPUT_POST, "salle", FILTER_SANITIZE_SPECIAL_CHARS);
$id_cours = filter_input(INPUT_POST, "id_cours", FILTER_SANITIZE_SPECIAL_CHARS);
$id_personne = filter_input(INPUT_POST, "id_personne", FILTER_SANITIZE_SPECIAL_CHARS);
$id_matiere = filter_input(INPUT_POST, "id_matiere", FILTER_SANITIZE_SPECIAL_CHARS);
$id_promo = filter_input(INPUT_POST, "id_promo", FILTER_SANITIZE_SPECIAL_CHARS);
$status = filter_input(INPUT_POST, "status", FILTER_SANITIZE_SPECIAL_CHARS);
$date = filter_input(INPUT_POST, "date", FILTER_SANITIZE_SPECIAL_CHARS);
$dateHeure = filter_input(INPUT_POST, "dateHeure", FILTER_SANITIZE_SPECIAL_CHARS);

$timeZone = new DateTimeZone("Europe/Paris");
$d = DateTime::createFromFormat('Y-m-d H:i:s', $date . ' ' . $dateHeure, $timeZone);
if ($d != false) {
    $dateTimeStamp = $d->getTimestamp();

    $all = [$coursIntitule, $matiereIntitule, $commentaires, $promoIntitule, $nbParticipants,
        $duree, $salle, $id_cours, $id_personne, $id_matiere, $id_promo, $status, $date,
        $dateHeure, $dateTimeStamp, $timeZone, $d];
    var_dump($all);
} else {
    header('location: /tuteur-cours');
}
//    todo faire la requete hpost
