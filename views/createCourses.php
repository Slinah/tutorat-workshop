<?php

include_once "includes/composants/nav-bar.php";

$id_proposition = filter_input(INPUT_POST, 'id_proposition',FILTER_SANITIZE_SPECIAL_CHARS);
$id_createur = filter_input(INPUT_POST, 'id_createur',FILTER_SANITIZE_SPECIAL_CHARS);
$id_matiere = filter_input(INPUT_POST, "id_matiere",FILTER_SANITIZE_SPECIAL_CHARS);
$id_promo = filter_input(INPUT_POST, "id_promo",FILTER_SANITIZE_SPECIAL_CHARS);

//Si on ne récupére aucune valeur, alors on met le value set à false, pour pouvoir savoir quand est ce qu'on préremplis le formulaire ou non
if ($id_proposition == null && $id_createur == null && $id_createur == null && $id_promo == null) {
    $valueSet = false;
} else {
//    si il y a des valeurs qui ont étés récupérés par les filters input alors, on passe le value set à true
    $valueSet = true;
}

// todo voir avec le guard et le système de connexion plus tard ^^
$idPersonneConnecter = "6593c62a-f0e3-11ea-adc1-0242ac120002";
// on récupéres toutes les matières // toutes les promos // toutes les infos de la personne par rapport a son id
$getMatiere = hget("http://localhost:4567/api/matieres");
$getPromo = hget("http://localhost:4567/api/promos");
$getInfosPersonne = hget("http://localhost:4567/api/personneById?idPeople=" . $idPersonneConnecter . "");
?>

<div class="login-box">
    <h2>Donner un cours</h2>
    <form method="post" action="/actions/actionsCreateCourse.php">
        <div class="user-box">
            <div class="user-box">
                <input type="text" name="intitule" required>
                <label>Le titre de votre cours !</label>
            </div>
            <input type="hidden" name="id_personne" value="<?= $idPersonneConnecter ?>">
            <select name="id_matiere" id="matiere-select" required>
                <option value="">matière</option>
                <?php
                if ($getMatiere != null) {
                    foreach ($getMatiere as $ligneMatiere) {
                        echo "<option value='" . $ligneMatiere->id_matiere . "'";
                        if ($valueSet && $ligneMatiere->id_matiere == $id_matiere) {
                            echo " selected";
                        }
                        echo ">" . $ligneMatiere->intitule;
                        echo "</option>";
                    }
                } else {
                    echo "<option value=''>Aucune matière n'a pu être récupérer</option>";
                } ?>
            </select>
        </div>
        <div class="user-box">
            <select name="id_promo" id="promo-select" required>
                <option value="">promo</option>
                <?php
                if ($getPromo != null) {
                    foreach ($getPromo as $lignePromo) {
                        echo "<option value='" . $lignePromo->id_promo . "'";
                        if ($valueSet && $lignePromo->id_promo == $id_promo) {
                            echo " selected";
                        }
                        echo ">" . $lignePromo->intitule;
                        echo "</option>";
                    }
                } else {
                    echo "<option value=''>Aucune promo n'a pu être récupérer</option>";
                } ?>
            </select>
        </div>
        <br>
        <div class="user-box">
            <input type="text" name="commentaires">
            <label>Indiquez ce que vous allez voir dans le cours !</label>
        </div>
        <div class='user-box'>
            <input type='date' name='date' required value='" . date("Y-m-d", strtotime($ligne->date)) . "'>
            <label>date</label>
        </div>
        <div class='user-box'>
            <input type='time' name='dateHeure' required value='" . date("H:i:s", strtotime($ligne->date)) . "'>
            <label>heure</label>
        <button type="submit">Envoyer la demande</button>
        <a class="btn" href="/suggestion-liste">
            <span></span>
            <span></span>
            <span></span>
            <span></span>Voir la liste des suggestions
        </a>
    </form>
</div>
