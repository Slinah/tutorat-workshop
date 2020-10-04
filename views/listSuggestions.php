<?php
//todo gestion des retours ?
include_once "includes/composants/nav-bar.php";

$idPersonneConnecter=(string)($_SESSION["me"]->id_personne);
$getSuggestion = hget("http://localhost:4567/api/unclosedProposals");
if(property_exists((object)$getSuggestion, "error")){
    $getSuggestion=null;
}
$getInfosPersonne = hpost("http://localhost:4567/api/personneByIdFull" , array("idPeople" => $idPersonneConnecter));
if(property_exists((object)$getInfosPersonne, "error")){
    $getInfosPersonne=null;
}
if (isset($_SESSION['retourUser'])) {
    retourUtilisateur($_SESSION['retourUser']);
}
?>
<section id='inSemaine' class='headerTitle'>
    <h2>Liste des suggestions</h2>
</section>
<section class='cardContainer'>
    <?php
    $i = 0;
    if (!property_exists((object)$getSuggestion, "error")) {
        foreach ($getSuggestion as $ligne) {
            echo "
            <section class='card'>
            <header>" . $ligne->matiere . "</header>
            <br>" . $ligne->commentaire . "
            </p>
            <form method='post' action='/donner-cours'>
            <input type='hidden' name='id_proposition' value='" . $ligne->id_proposition . "'> 
            <input type='hidden' name='id_createur' value='" . $ligne->id_createur . "'>
            <input type='hidden' name='id_matiere' value='" . $ligne->id_matiere . "'>
            <input type='hidden' name='id_promo' value='" . $ligne->id_promo . "'>
            ";
            echo "<button type='submit'>Créer le cours</button>";
            echo "
            </form>
            <div class='classeUpLeft'>" . $ligne->promo . "</div>";
            echo "</section>";
            $courCetteSemaine = 0;
        }
    } else {
        echo "Aucune suggestions pour le moment";
    }
    ?>
</section>
