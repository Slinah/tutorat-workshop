<?php
require_once "../includes/functions.php";
session_start();


$idPersonne = filter_input(INPUT_POST, 'id_personne', FILTER_SANITIZE_SPECIAL_CHARS);
$idMatiere = filter_input(INPUT_POST, 'matiere', FILTER_SANITIZE_SPECIAL_CHARS);
$idPromo = filter_input(INPUT_POST, "id_promo", FILTER_SANITIZE_SPECIAL_CHARS);
$commentaire = filter_input(INPUT_POST, "commentaire", FILTER_SANITIZE_SPECIAL_CHARS);


//    ajout dans proposition
$idProposition = hpost("http://localhost:4567/api/sendProposalsCoursesPeople", array("id_createur" => $idPersonne, "id_matiere" => $idMatiere, "commentaire" => $commentaire));
//    ajout dans proposition promo
if ($idProposition) {

    $_SESSION['retourUser'] = hpost("http://localhost:4567/api/sendProposalsCoursesPromo", array("id_proposition" => $idProposition, "id_promo" => $idPromo));
}

header("Location: /suggestion-cours");
