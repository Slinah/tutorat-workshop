<?php
include_once "includes/composants/nav-bar.php";

$idPersonneConnecter=(string)($_SESSION["me"]->id_personne);
$getMatiere = hget("http://localhost:4567/api/matieres");
if(property_exists((object)$getMatiere, "error")){
    $getMatiere=null;
}
$getInfosPersonne = hpost("http://localhost:4567/api/personneByIdFull" , array("idPeople" => $idPersonneConnecter));
if(property_exists((object)$getInfosPersonne, "error")){
    $getInfosPersonne=null;
}
if (isset($_SESSION['retourUser'])) {
    retourUtilisateur($_SESSION['retourUser']);
}
?>

<div class="login-box">
    <h2>Suggérer un cours</h2>
    <form method="post" action="/actions/actionsSendingSuggestion.php" id="formEnter">
        <input type="hidden" name="id_personne" value="<?= $idPersonneConnecter ?>">
        <?php
        // on gère le cas ou les infos de la personnes ne sont pas bien récupérés
        if ($getInfosPersonne != null) { ?>
            <input type="hidden" name="id_promo" value="<?= $getInfosPersonne[0]->id_promo ?>">
        <?php } else {
            echo "Une erreur est survenue, nous n'avons pas réussi à récupérer les infos de la personne connecter !";
        } ?>
        <div class="user-box">
            <select name="matiere" id="matiere-select" required>
                <option value="">Matière demandée</option>
                <?php
                // on gère le cas ou les matières sont pas récupérés
                if ($getMatiere != null) {
                    foreach ($getMatiere as $ligneMatiere) {
                        echo "<option value='" . $ligneMatiere->id_matiere . "'>" . $ligneMatiere->intitule . "</option>";
                    }
                } else {
                    echo "<option value=''>une erreur est survenue, aucune matière à afficher</option>";
                }
                ?>
            </select>
        </div>
        une matière que tu souhaiterais et qui n'est pas dans la liste ?
        <a class="btn" href="/creer-matiere">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            clique ici & demande à l'ajouter
        </a>
        <br>
        <div class="user-box">
            <input type="text" name="commentaire">
            <label>Indique ce que tu souhaiterais aborder dans le cours !</label>
        </div>
        <button type="submit">Envoyer la demande</button>
    </form>
</div>
