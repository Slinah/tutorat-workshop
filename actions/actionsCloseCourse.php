<?php
require_once "../includes/functions.php";
session_start();

$nbInscrit = filter_input(INPUT_POST, "nbInscrit", FILTER_SANITIZE_SPECIAL_CHARS);
$coursIntitule = filter_input(INPUT_POST, "coursIntitule", FILTER_SANITIZE_SPECIAL_CHARS);
$matiereIntitule = filter_input(INPUT_POST, "matiereIntitule", FILTER_SANITIZE_SPECIAL_CHARS);
$commentaires = filter_input(INPUT_POST, "commentaires", FILTER_SANITIZE_SPECIAL_CHARS);
$promoIntitule = filter_input(INPUT_POST, "promoIntitule", FILTER_SANITIZE_SPECIAL_CHARS);
$nbParticipants = filter_input(INPUT_POST, "nbParticipants", FILTER_SANITIZE_SPECIAL_CHARS);
$duree = filter_input(INPUT_POST, "duree", FILTER_SANITIZE_SPECIAL_CHARS);
$salle = filter_input(INPUT_POST, "salle", FILTER_SANITIZE_SPECIAL_CHARS);
$id_cours = filter_input(INPUT_POST, "id_cours", FILTER_SANITIZE_SPECIAL_CHARS);
$id_personne = filter_input(INPUT_POST, "id_personne", FILTER_SANITIZE_SPECIAL_CHARS);
$id_matiere = filter_input(INPUT_POST, "id_matiere", FILTER_SANITIZE_SPECIAL_CHARS);
$id_promo = filter_input(INPUT_POST, "id_promo", FILTER_SANITIZE_SPECIAL_CHARS);
$date = filter_input(INPUT_POST, "date", FILTER_SANITIZE_SPECIAL_CHARS);
$dateHeure = filter_input(INPUT_POST, "dateHeure", FILTER_SANITIZE_SPECIAL_CHARS);

$infoPeoplePresent=[$nbInscrit];
for($x=0;$x<$nbInscrit;$x++){
    $infoPeoplePresent[$x]=filter_input(INPUT_POST, ("radio".(string)$x), FILTER_SANITIZE_SPECIAL_CHARS);
}

if($nbParticipants===""){
    $nbParticipants=0;
}
$duree = filter_input(INPUT_POST, 'duree', FILTER_SANITIZE_SPECIAL_CHARS);

if($duree===""){
    $duree=0;
}
$salle = filter_input(INPUT_POST, "salle", FILTER_SANITIZE_SPECIAL_CHARS);

if($salle===""){
    $salle=0;
}

$timeZone = new DateTimeZone("Europe/Paris");
$format = 'Y-m-d H:i:s';
$d = DateTime::createFromFormat($format, $date . ' ' . $dateHeure, $timeZone);


if ($d != null) {
    foreach ($infoPeoplePresent as $people){
        if($people!=0){
            hpost("http://localhost:4567/api/experiencePeople", array("idPeople"=>$people,"experience"=>round($duree,0)));
        }
    }
    $d = $d->format('Y-m-d H:i:s');
    $_SESSION['retourUser']=hpost("http://localhost:4567/api/postCloseCourse", array("id_cours"=>$id_cours,"id_matiere"=>$id_matiere,
        "id_promo"=>$id_promo,"intitule"=>$coursIntitule, "date"=>$d, "commentaires"=>$commentaires, "nb_participants"=>$nbParticipants,
        "duree"=>$duree,"salle"=>$salle));
    header('location: /tuteur-cours');
} else{
    header('location: /tuteur-cours');
}

