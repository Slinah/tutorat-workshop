<?php

include_once "includes/composants/nav-bar.php";

// todo rien ne va dans cette page -


$unclosedCourses = hget("http://localhost:4567/api/unclosedCourses");
$timeZone = new DateTimeZone("Europe/Paris");
$dateTime = new DateTime("now", $timeZone);
$semaineActuelle = (int)date("W", $dateTime->getTimestamp());
$courCetteSemaine = 1;
$courSemaineProchaine = 1;
$coursPlusTard = 1;
// todo voir avec le guard et le système de connexion plus tard ^^
$idPersonneConnecter = "6593c62a-f0e3-11ea-adc1-0242ac120002";
$getCoursById = hget("http://localhost:4567/api/peopleCourseById?idPeople=" . $idPersonneConnecter);
if ($getCoursById = !null) {
    foreach ($getCoursById as $ligne) {
        $tabGetCoursById[] = $ligne->id_cours;
    }
}
?>


<section id='inSemaine' class='headerTitle'>
    <h2>Liste des suggestions</h2>
</section>
<section class='cardContainer'>
    <?php
    $i = 0;
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
    ?>
</section>
