<?php
require_once "../includes/functions.php";

$idPersonne = filter_input(INPUT_POST, 'id_personne');
$idMatiere = filter_input(INPUT_POST, 'id_matiere');
$idPromo = filter_input(INPUT_POST, "id_promo");
$intitule = filter_input(INPUT_POST,"intitule");
$date = filter_input(INPUT_POST,"date");
$commentaires = filter_input(INPUT_POST, "commentaires");

//    ajout du cours, suppression des propositions associés, ajout du cours en lui meme, et du lien avec le cours, la matière, la promo, et la personne
// ajout également dans la table personne_cours
//   postCourse(params[:id_personne], params[:id_matiere], params[:id_promo], params[:intitule], params[:date], params[:commentaires] )
// todo verif si ça marche (je sais pas mdr)
// todo dodo a ce moment :3
    $idProposition=hpost("http://localhost:4567/api/postCourse", array("id_personne"=>$idPersonne,"id_matiere"=>$idMatiere, "commentaire"=>$idPromo, "date"=>$date, "commentaires"=>$commentaires));

header("Location: http://workshop/cours#inSemaine");
