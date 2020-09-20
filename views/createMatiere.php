<?php
include_once "includes/composants/nav-bar.php";

$idPersonneConnecter = (string)($_SESSION["me"]->id_personne);
$getMatiere = hget("http://localhost:4567/api/matieres");
if (property_exists((object)$getMatiere, "error")) {
    $getMatiere = null;
}
$getInfosPersonne = hpost("http://localhost:4567/api/personneByIdFull", array("idPeople" => $idPersonneConnecter));
if (property_exists((object)$getInfosPersonne, "error")) {
    $getInfosPersonne = null;
}
if (isset($_SESSION['retourUser'])) {
    retourUtilisateur($_SESSION['retourUser']);
}
?>

<div class="login-box">
    <h2>Demande l'ajout d'une matière</h2>
    <form method="post" action="/actions/actionsSendingMatiere.php">
        <div class="user-box">
            <input type="text" name="matiere" required>
            <label>Indiquez la matière que vous voudriez ajouter !</label>
        </div>
        <button type="submit">Envoyer la demande</button>
    </form>
</div>
