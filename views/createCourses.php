<?php

include_once "includes/composants/nav-bar.php";

$id_proposition = filter_input(INPUT_POST, 'id_proposition');
$id_createur = filter_input(INPUT_POST, 'id_createur');
$id_matiere = filter_input(INPUT_POST, "id_matiere");
$id_promo = filter_input(INPUT_POST,"id_promo");


if ($id_proposition==null && $id_createur==null && $id_createur==null && $id_promo== null){
    var_dump("valeurs toutes nulles");
    $valueSet=false;
} else{
    $valueSet=true;
    var_dump(array("id_proposition"=>$id_proposition,"id_createur"=>$id_createur,"id_matiere"=>$id_matiere,"id_promo"=>$id_promo));
}
// todo voir avec le guard et le système de connexion plus tard ^^
$idPersonneConnecter="6593c62a-f0e3-11ea-adc1-0242ac120002";
$getMatiere=hget("http://localhost:4567/api/matieres");
$getPromo=hget("http://localhost:4567/api/promos");
$getInfosPersonne=hget("http://localhost:4567/api/personneById?idPeople=".$idPersonneConnecter."");
?>

<div class="login-box">
    <h2>Donner un cours</h2>
    <form method="post" action="/actions/actionsCreateCourse.php">
        <div class="user-box">
            <div class="user-box">
                <input type="text" name="intitule">
                <label>Le titre de votre cours !</label>
            </div>
            <input type="hidden" name="id_personne" value="<?= $idPersonneConnecter ?>">
            <select name="id_matiere" id="matiere-select">
                <option value="">matière</option>
                <?php foreach ($getMatiere as $ligneMatiere){
                    echo "<option value='".$ligneMatiere->id_matiere."'";
                    if($valueSet && $ligneMatiere->id_matiere==$id_matiere){
                        echo " selected";
                    }
                    echo ">".$ligneMatiere->intitule;
                    echo "</option>";
                } ?>
            </select>
        </div>
        <div class="user-box">
            <select name="id_promo" id="promo-select">
                <option value="">promo</option>
                <?php foreach ($getPromo as $lignePromo){
                    echo "<option value='".$lignePromo->id_promo."'";
                    if($valueSet && $lignePromo->id_promo==$id_promo){
                        echo " selected";
                    }
                    echo ">".$lignePromo->intitule;
                    echo "</option>";
                } ?>
            </select>
        </div>
        <br>
        <div class="user-box">
            <input type="text" name="commentaires">
            <label>Indiquez ce que vous allez voir dans le cours !</label>
        </div>
        <div class="user-box">
            <input type="datetime-local" name="date" required="">
            <label>Date & heure</label>
        </div>
        <button type="submit">Envoyer la demande</button>
        <a class="btn" href="/suggestion-liste">
            <span></span>
            <span></span>
            <span></span>
            <span></span>Voir la liste des suggestions
        </a>
    </form>
</div>
