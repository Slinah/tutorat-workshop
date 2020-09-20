<?php
include_once "includes/composants/nav-bar.php";

$unclosedCourses = hget("http://localhost:4567/api/unclosedCourses");
if(property_exists((object)$unclosedCourses, "error")){
    $unclosedCourses=null;
}
$timeZone = new DateTimeZone("Europe/Paris");
$dateTime = new DateTime("now", $timeZone);
$semaineActuelle = (int)date("W", $dateTime->getTimestamp());
$courCetteSemaine = 1;
$courSemaineProchaine = 1;
$coursPlusTard = 1;
$timeZone = new DateTimeZone("Europe/Paris");
$dateTime = new DateTime("now", $timeZone);
$dateDuJour = date("Y-m-d", $dateTime->getTimestamp());
$idPersonneConnecter = (string)($_SESSION["me"]->id_personne);
// on recupere la liste des cours ou la personne est tutoraté :3
$getCoursById = hget("http://localhost:4567/api/peopleTutorCourseById?idPeople=" . $idPersonneConnecter);
if(property_exists((object)$getCoursById, "error")){
    $getCoursById=null;
}
if (isset($_SESSION['retourUser'])) {
    retourUtilisateur($_SESSION['retourUser']);
}
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
            <form method='post' action='/actions/actionsModifyCourse' class='login-box' id='formulaireModifyCourse" . $i . "'>
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
                <input type='number' step='0.1' name='duree' value='" . $ligne->duree . "'>
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
            <div class='user-box'>
            <input type='date' name='date' min='".$dateDuJour."' required value='" . date("Y-m-d", strtotime($ligne->date)) . "'>
            <label>date</label>
            </div>
            <div class='user-box'>
            <input type='time' name='dateHeure' required value='" . date("H:i:s", strtotime($ligne->date)) . "'>
            <label>heure</label>
            </div>";
            echo "<button type='submit'>Envoyer</button>
            </form>
            <form method='post' action='/actions/actionsCloseCourse' id='formulaireCloseCourse" . $i . "'>
            <input type='hidden' name='coursIntitule' value='" . $ligne->coursIntitule . "'>
            <input type='hidden' name='matiereIntitule' value='" . $ligne->matiereIntitule . "'>
            <input type='hidden' name='commentaires' value='" . $ligne->commentaires . "'>
            <input type='hidden' name='promoIntitule' value='" . $ligne->promoIntitule . "'>
            <input type='hidden' name='nbParticipants' value='" . $ligne->nbParticipants . "'>
            <input type='hidden' step='0.1' name='duree' value='" . $ligne->duree . "'>
            <input type='hidden' name='salle' value='" . $ligne->salle . "'>
            <input type='hidden' name='id_cours' value='" . $ligne->id_cours . "'>
            <input type='hidden' name='id_personne' value='" . $ligne->id_personne . "'>
            <input type='hidden' name='id_matiere' value='" . $ligne->id_matiere . "'>
            <input type='hidden' name='id_promo' value='" . $ligne->id_promo . "'>
            <input type='hidden' name='date' value='" . date("Y-m-d", strtotime($ligne->date)) . "'>
            <input type='hidden' required name='dateHeure' value='" . date("H:i:s", strtotime($ligne->date)) . "'>
            <button type='button' id='clore" . $i . "'>Cloturer le cours</button>
            </form>
            </section>";
            $courCetteSemaine = 0;
            $i++;
        }
//        matiere // commentaire // id_proposition // id_createur // id_matiere // id_promo // salle // date // nbParticipants // duree // status //
    } else {
        echo "<section class='card'>
              <h2>Vous n'avez prévu aucun cours</h2>
              </section>";
    }
    ?>
</section>
<script src="/ressources/js/jquery.js"></script>
<script>
    function form2form(formA, formB) {
        $(':input[name]', formA).each(function () {
            $('[name=' + $(this).attr('name') + ']', formB).val($(this).val())
        })
    }
    <?php for ($i;$i > 0;$i--){?>
    $(function () {
        $('#clore<?php echo $i-1 ?>').click(function () {
            form2form($("#formulaireModifyCourse<?php echo $i-1 ?>"), $("#formulaireCloseCourse<?php echo $i-1 ?>"));
            $("#formulaireCloseCourse<?php echo $i-1 ?>").submit();
        });
    });
    <?php } ?>
</script>
