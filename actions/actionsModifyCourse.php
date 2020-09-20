<?php
require_once "../includes/functions.php";
session_start();

$coursIntitule = filter_input(INPUT_POST, 'coursIntitule');
$matiereIntitule = filter_input(INPUT_POST, 'matiereIntitule');
$commentaires = filter_input(INPUT_POST, "commentaires");
$promoIntitule = filter_input(INPUT_POST,"promoIntitule");
$nbParticipants = filter_input(INPUT_POST, 'nbParticipants');
if($nbParticipants===""){
    $nbParticipants=0;
}
$duree = filter_input(INPUT_POST, 'duree');
if($duree===""){
    $duree=0;
}
$salle = filter_input(INPUT_POST, "salle");
var_dump($salle);
if($salle===""){
    $salle=0;
}
$id_cours = filter_input(INPUT_POST,"id_cours");
$id_personne = filter_input(INPUT_POST,"id_personne");
$id_matiere = filter_input(INPUT_POST,"id_matiere");
$id_promo = filter_input(INPUT_POST,"id_promo");
$date = filter_input(INPUT_POST,"date");
$dateHeure = filter_input(INPUT_POST,"dateHeure");

$timeZone = new DateTimeZone("Europe/Paris");
$format = 'Y-m-d H:i:s';
$d = DateTime::createFromFormat($format,  $date.' '.$dateHeure,$timeZone);

if ($d != null) {
    $d = $d->format('Y-m-d H:i:s');
    $_SESSION['retourUser']=hpost("http://localhost:4567/api/postModifCourse", array("id_cours"=>$id_cours,"id_matiere"=>$id_matiere,
        "id_promo"=>$id_promo,"intitule"=>$coursIntitule, "date"=>$d, "commentaires"=>$commentaires, "nb_participants"=>$nbParticipants,
        "duree"=>$duree,"salle"=>$salle));
    header('location: /tuteur-cours');
}else{
    header('location: /tuteur-cours');
}

