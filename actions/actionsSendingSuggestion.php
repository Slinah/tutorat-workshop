<?php
require_once "../includes/functions.php";

$idPersonne = filter_input(INPUT_POST, 'id_personne');
$idMatiere = filter_input(INPUT_POST, 'matiere');
$idPromo = filter_input(INPUT_POST, "id_promo");
$commentaire = filter_input(INPUT_POST,"commentaire");

//    ajout dans proposition
    $idProposition=hpost("http://localhost:4567/api/sendProposalsCoursesPeople", array("id_createur"=>$idPersonne,"id_matiere"=>$idMatiere, "commentaire"=>$commentaire));
//    ajout dans proposition promo
    if($idProposition){
        hpost("http://localhost:4567/api/sendProposalsCoursesPromo", array("id_proposition"=>$idProposition,"id_promo"=>$idPromo));
    }

header("Location: http://workshop/cours#inSemaine");
