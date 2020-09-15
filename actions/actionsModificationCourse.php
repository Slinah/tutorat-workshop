<?php
require_once "../includes/functions.php";

$idPersonne = filter_input(INPUT_POST, 'id_personne');
$idMatiere = filter_input(INPUT_POST, 'promoIntitule');
$idPromo = filter_input(INPUT_POST, "rang_personne");
$commentaire = filter_input(INPUT_POST,"id_matiere");
$idPersonne = filter_input(INPUT_POST, 'id_personne');
$idMatiere = filter_input(INPUT_POST, 'id_promo');
$idPromo = filter_input(INPUT_POST, "coursIntitule");
$date = filter_input(INPUT_POST,"date");
$heure = filter_input(INPUT_POST,"heure");
$commentaires = filter_input(INPUT_POST,"commentaires");
$nbParticipants = filter_input(INPUT_POST,"nbParticipants");
$duree = filter_input(INPUT_POST,"duree");
$status = filter_input(INPUT_POST,"status");
$salle = filter_input(INPUT_POST,"salle");
$matiereIntitule = filter_input(INPUT_POST,"matiereIntitule");

$timeZone = new DateTimeZone("Europe/Paris");
$d = DateTime::createFromFormat(
    'd-m-Y H:i:s',
    $date.' '.$heure,
    $timeZone
);
$dateTimeStamp = $d->getTimestamp();

//    ajout dans proposition
    $idProposition=hpost("http://localhost:4567/api/sendProposalsCoursesPeople", array("id_createur"=>$idPersonne,"id_matiere"=>$idMatiere, "commentaire"=>$commentaire));
//    ajout dans proposition promo
    if($idProposition){
        hpost("http://localhost:4567/api/sendProposalsCoursesPromo", array("id_proposition"=>$idProposition,"id_promo"=>$idPromo));
    }

header("Location: http://workshop/cours#inSemaine");

