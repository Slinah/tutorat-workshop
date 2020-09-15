<?php

include_once "includes/composants/nav-bar.php";
// todo si admin alors bouton en plus pour suppr le cours

$unclosedCourses = hget("http://localhost:4567/api/unclosedCourses");
$timeZone = new DateTimeZone("Europe/Paris");
$dateTime = new DateTime("now", $timeZone);
$semaineActuelle = (int)date("W", $dateTime->getTimestamp());
$courCetteSemaine = 1;
$courSemaineProchaine = 1;
$coursPlusTard = 1;
// todo voir avec le guard et le système de connexion plus tard ^^
$idPersonneConnecter = "6593c62a-f0e3-11ea-adc1-0242ac120002";
// on recupere la liste des cours ou la personne est tutoraté :3
$getCoursById = hget("http://localhost:4567/api/peopleTutorCourseById?idPeople=" . $idPersonneConnecter);

?>

<section id='inSemaine' class='headerTitle'>
    <h2>Liste des cours que vous donnez</h2>
</section>
<section class='cardContainer'>
    <?php
    if ($getCoursById != null) {
        $i = 0;
        foreach ($getCoursById as $ligne) {
            echo "
            <section class='card'>
            <header>Administration du cours</header>
            <form method='post' action='/actions/actionsModificationCourse' class='login-box' id='formulaireModifyCourse'>
            <div class='user-box'> 
                <input type='text' name='coursIntitule' value='" . $ligne->coursIntitule . "'>
                <label>Titre du cours</label>
            </div>
            <div class='user-box'>
                <input type='text' name='matiereIntitule' value='" . $ligne->matiereIntitule . "' disabled>
                <label>Matière ciblée</label>
            </div>
            <div class='user-box'>
                <input type='text' name='commentaires' value='" . $ligne->commentaires . "'>
                <label>Description du cours</label>
            </div>
            <div class='user-box'>
                <input type='text' name='promoIntitule' value='" . $ligne->promoIntitule . "' disabled>
                <label>Intitule de la promo</label>
            </div>
            <div class='user-box'>
                <input type='number' name='nbParticipants' value='" . $ligne->nbParticipants . "'>
                <label>Nombre de participants</label>
            </div>
            <div class='user-box'>
                <input type='number' name='duree' value='" . $ligne->duree . "'>
                <label>Duree (en heure, ex: 1h30 = 1.5)</label>
            </div>
            <div class='user-box'>
                <input type='number' name='salle' value='" . $ligne->salle . "'>
                <label>Salle</label>
            </div>
            </select>
            <input type='hidden' name='id_cours' value='" . $ligne->id_cours . "'>
            <input type='hidden' name='id_personne' value='" . $ligne->id_personne . "'>
            <input type='hidden' name='id_matiere' value='" . $ligne->id_matiere . "'>
            <input type='hidden' name='id_promo' value='" . $ligne->id_promo . "'>
            <input type='hidden' name='status' value='" . $ligne->status . "'>
            <div class='user-box'>
            <input type='date' name='date' required value='" . date("Y-m-d", strtotime($ligne->date)) . "'>
            <label>date</label>
            </div>
            <div class='user-box'>
            <input type='time' name='dateHeure' required value='" . date("H:i:s", strtotime($ligne->date)) . "'>
            <label>heure</label>
            </div>";
            echo "<button type='submit'>Envoyer</button>
            </form>
            <form action='/actions/actionsCloseCourse' id='formulaireCloseCourse'>
            <input type='hidden' name='coursIntitule' value='" . $ligne->coursIntitule . "'>
            <input type='hidden' name='matiereIntitule' value='" . $ligne->matiereIntitule . "'>
            <input type='hidden' name='commentaires' value='" . $ligne->commentaires . "'>
            <input type='hidden' name='promoIntitule' value='" . $ligne->promoIntitule . "'>
            <input type='hidden' name='nbParticipants' value='" . $ligne->nbParticipants . "'>
            <input type='hidden' name='duree' value='" . $ligne->duree . "'>
            <input type='hidden' name='salle' value='" . $ligne->salle . "'>
            <input type='hidden' name='id_cours' value='" . $ligne->id_cours . "'>
            <input type='hidden' name='id_personne' value='" . $ligne->id_personne . "'>
            <input type='hidden' name='id_matiere' value='" . $ligne->id_matiere . "'>
            <input type='hidden' name='id_promo' value='" . $ligne->id_promo . "'>
            <input type='hidden' name='status' value='" . $ligne->status . "'>
            <input type='hidden' name='date' value='" . date("Y-m-d", strtotime($ligne->date)) . "'>
            <input type='hidden' name='dateHeure' value='" . date("H:i:s", strtotime($ligne->date))  . "'>
            <button type='button' id='clore'>Cloturer le cours</button>
            </form>
            </section>";
            $courCetteSemaine = 0;
        }
//        matiere // commentaire // id_proposition // id_createur // id_matiere // id_promo // salle // date // nbParticipants // duree // status //
    } else {
        echo "<section class='card'>
              <header>vous n'avez aucun cours prévu</header>
              </section>";
    }
    ?>
</section>
<script type="text/javascript">

</script>
