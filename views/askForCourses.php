<?php

include_once "includes/composants/nav-bar.php";


// todo voir avec le guard et le système de connexion plus tard ^^
$idPersonneConnecter="6593c62a-f0e3-11ea-adc1-0242ac120002";
$getMatiere=hget("http://localhost:4567/api/matieres");
$getInfosPersonne=hget("http://localhost:4567/api/personneById?idPeople=".$idPersonneConnecter);
?>

<div class="login-box">
    <h2>Suggérer un cours</h2>
    <form method="post" action="/actions/actionsSendingSuggestion.php">
        <input type="hidden" name="id_personne" value="<?= $idPersonneConnecter ?>">
        <input type="hidden" name="id_promo" value="<?= $getInfosPersonne[0]->id_promo ?>">
        <div class="user-box">
            <select name="matiere" id="matiere-select">
                <option value="">matière demandée</option>
                <?php foreach ($getMatiere as $ligneMatiere){
                    echo "<option value='".$ligneMatiere->id_matiere."'>".$ligneMatiere->intitule."</option>";
                } ?>
            </select>
        </div>
        une matière que tu voudrais qui n'est pas dans la liste ?
        <a class="btn" href="/createMatiere">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            clique ici & demande à l'ajouter
        </a>
        <br>
        <div class="user-box">
            <input type="text" name="commentaire">
            <label>Indiquez ce que vous voudriez voir dans le cours !</label>
        </div>
        <button type="submit">Envoyer la demande</button>
    </form>
</div>
