<?php
require_once "../includes/functions.php";

$matiere = filter_input(INPUT_POST, 'matiere');

hpost("http://localhost:4567/api/sendCreateMatiere", array("matiere"=>$matiere));

header("Location: /suggestion-cours");
