<?php
require_once "../includes/functions.php";
session_start();

$id_personne = filter_input(INPUT_POST, "idPersonne", FILTER_SANITIZE_SPECIAL_CHARS);
$radioPref = filter_input(INPUT_POST, "radioPref", FILTER_SANITIZE_SPECIAL_CHARS);
$choixValid = false;
$data = hpost('http://localhost:4567/api/personneById', array('idPersonne' => $id_personne));
$nom = strtoupper($data->nom);
$experience = $data->experience;
$level = 0;
for ($x = 0; $x < $experience; $x++) {
    if ($x % 10 === 0) {
        $level++;
    }
}
switch ($radioPref) {
    case 1:
    case 2:
    case 3:
        if ($level >= 0) {
            $choixValid = true;
        }
        break;
    case 4:
        if ($level >= 2) {
            $choixValid = true;
        }
        break;
    case 5:
        if ($level >= 3) {
            $choixValid = true;
        }
        break;
    case 6:
        if ($level >= 4) {
            $choixValid = true;
        }
        break;
    case 7:
        if ($level >= 5) {
            $choixValid = true;
        }
        break;
    case 8:
        if ($level >= 6) {
            $choixValid = true;
        }
        break;
    case 9:
        if ($level >= 7) {
            $choixValid = true;
        }
        break;
    case 10:
        if ($level >= 10) {
            $choixValid = true;
        }
        break;
    case 200:
        if (strtoupper($data->ecole) === 'EPSI') {
            $choixValid = true;
        }
        break;
    case 201:
        if (strtoupper($data->ecole) === 'WIS') {
            $choixValid = true;
        }
        break;
    case 202:
        if (strtoupper($data->intitulePromo) === 'B2') {
            $choixValid = true;
        }
        break;
    case 203:
        $choixValid = true;
        break;
    case 400:
        if ($nom === 'CATIFAIT' || $nom === 'BARITEAU' || $nom === 'GAUTHIER' || $nom === 'LE FLOCH' || $nom === 'CINQUIN' || $nom === 'MENANTEAU' || $nom === 'DEZETTRE') {
            $choixValid = true;
        }
        break;
    case 600:
        if ($nom === 'DEZETTRE') {
            $choixValid = true;
        }
        break;
    case 601:
        if ($nom === 'MENANTEAU') {
            $choixValid = true;
        }
        break;
    case 602:
        if ($nom === 'CATIFAIT') {
            $choixValid = true;
        }
        break;
    case 603:
        if ($nom === 'BARITEAU') {
            $choixValid = true;
        }
        break;
    case 604:
        if ($nom === 'GAUTHIER') {
            $choixValid = true;
        }
        break;
    case 605:
        if ($nom === 'LE FLOCH') {
            $choixValid = true;
        }
        break;
    case 606:
        if ($nom === 'CINQUIN') {
            $choixValid = true;
        }
        break;
}
var_dump($choixValid);
if ($choixValid === true) {
    $_SESSION['retourUser'] = hpost("http://localhost:4567/api/postModifPref", array("idPersonne" => $id_personne, "idCursor" => $radioPref));
    header('location: /profile');
} else {
    $_SESSION['retourUser'] = (object)array("error" => "Bien essayé ;) ! Petit malin ! ♥ ");
    header('location: /profile');
}


