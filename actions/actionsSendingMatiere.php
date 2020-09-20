<?php
require_once "../includes/functions.php";
session_start();

$matiere = filter_input(INPUT_POST, 'matiere');

$_SESSION['retourUser']=hpost("http://localhost:4567/api/sendCreateMatiere", array("matiere"=>$matiere));

header("Location: /creer-matiere");
