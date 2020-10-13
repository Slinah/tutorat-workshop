<?php
include_once "includes/composants/nav-bar.php";

$unclosedCourses = hget("http://localhost:4567/api/unclosedCourses");
if (property_exists((object)$unclosedCourses, "error")) {
    $unclosedCourses = null;
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
$getCoursById = hpost("http://localhost:4567/api/peopleTutorCourseById", array('idPeople' => $idPersonneConnecter));
if (property_exists((object)$getCoursById, "error")) {
    $getCoursById = null;
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
            <form method='post' action='/actions/actionsModifyCourse.php' class='login-box' id='formulaireModifyCourse" . $i . "'>
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
                <input type='number' name='nbParticipants' id='nbParticipants" . $i . "' value='" . $ligne->nbParticipants . "'>
                <label>Nombre de participants</label>
            </div>
            <div class='user-box'>
                <input type='number' step='0.1' name='duree' id='duree" . $i . "' value='" . $ligne->duree . "'>
                <label>Durée (en heure, ex: 1h30 = 1.5)</label>
            </div>
            <div class='user-box'>
                <input type='number' name='salle' value='" . $ligne->salle . "'>
                <label>Salle</label>
            </div>
            </select>
            <input type='hidden' name='id_cours' id='id_cours" . $i . "' value='" . $ligne->id_cours . "'>
            <input type='hidden' name='id_personne' value='" . $ligne->id_personne . "'>
            <input type='hidden' name='id_matiere' value='" . $ligne->id_matiere . "'>
            <input type='hidden' name='id_promo' value='" . $ligne->id_promo . "'>
            <div class='user-box'>";
            $dateTimeFormatage = new DateTime($ligne->date, $timeZone);
            echo "
            <input type='date' name='date' required value='" . $dateTimeFormatage->format("Y-m-d") . "'>
            <label>date</label>
            </div>
            <div class='user-box'>
            <input type='time' name='dateHeure' required value='" . $dateTimeFormatage->format("H:i:s") . "'>
            <label>heure</label>
            </div>";
            echo "<button type='submit'>Envoyer</button>
            </form>
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
<!-- id cours -->
<section id="modalId" class="modal">
    <input type="hidden" id="personne_id" value="<?php echo $_SESSION["me"]->id_personne; ?>">
    <div class="container">
        <div class="comment">
            <h2>Présence : </h2>
            <form method="post" action="/actions/actionsCloseCourse.php" id="formModal">
                <input type='hidden' name='nbInscrit' id='nbInscrit' value=''>
                <input type='hidden' name='coursIntitule' value=''>
                <input type='hidden' name='matiereIntitule' value=''>
                <input type='hidden' name='commentaires' value=''>
                <input type='hidden' name='promoIntitule' value=''>
                <input type='hidden' name='nbParticipants' value=''>
                <input type='hidden' name='duree' value=''>
                <input type='hidden' name='salle' value=''>
                <input type='hidden' name='id_cours' value=''>
                <input type='hidden' name='id_personne' value=''>
                <input type='hidden' name='id_matiere' value=''>
                <input type='hidden' name='id_promo' value=''>
                <input type='hidden' name='date' value=''>
                <input type='hidden' name='dateHeure' value=''>
            </form>
        </div>
        <div class="closeButton" onclick="clickCloseBtnModal()">
            &cross;
        </div>
    </div>
</section>
<script src="/ressources/js/jquery.js"></script>
<script>
    var indexGen = 0;

    function form2form(formA, formB) {
        $(':input[name]', formA).each(function () {
            $('[name=' + $(this).attr('name') + ']', formB).val($(this).val());
        })
        $(':input[date]', formA).each(function () {
            $('[name=' + $(this).attr('name') + ']', formB).val($(this).val());
        })
        $(':input[time]', formA).each(function () {
            $('[name=' + $(this).attr('name') + ']', formB).val($(this).val());
        })
    }

    function clickCoursModal(numberForm) {
        var infoPeople = [];
        for (var x = 0; x < indexGen; x++) {
            var test = $("input[name='radio" + x + "']:checked").val();
            if (test !== '0') {
                infoPeople.push(test);
            }
        }
        //pb
        $("#nbParticipants" + numberForm).val(infoPeople.length);
        experience = Math.round($("#duree" + numberForm).val());
        idCourse = $("#id_cours" + numberForm).val();
        $("#nbInscrit").val(indexGen);
        form2form($("#formulaireModifyCourse" + numberForm), $("#formModal"));
        $("#formModal").submit();
        // on récupére dans info people toutes les id des gens marqués comme présent
        // on recupere dans numberForm, le numéro du formulaire qu'on est en train de traiter
        // on recupere dans infoPeople.lenght, le nombre de participant total
        // faire une boucle avec ces éléments pour ajoutés l'expérience
        // et faire en sorte que si le cours est 'off' , alors on ne donne pas d'xp
    }
    <?php for ($i;$i > 0;$i--){?>
    $(function () {
        $('#clore<?php echo $i - 1 ?>').click(function () {
            var numberForm = <?= $i - 1 ?>;
            var idCours = $("#id_cours" + numberForm).val();
            http_post("https://api.scratchoverflow.fr/api/listPeopleCourseById", {
                "idCourse": idCours
            }).then(value => {
                value = JSON.parse(value);
                for (var i = 0; i < value.length; i++) {
                    $('#formModal').append("<input type='hidden' name='idCoursModal" + i + "' id='id_coursModal" + i + "' value='" + value[i]["id_cours"] + "'>" +
                        "<fieldset name='fieldModal" + i + "'>" +
                        "                    <legend>" + value[i]["nom"] + " - " + value[i]["prenom"] + "</legend>\n" +
                        "                    <input type=\"radio\" name=\"radio" + i + "\" id=\"radio" + i + "\" value='" + value[i]["id_personne"] + "'> <label for=\"radio" + i + "\">Oui</label>\n" +
                        "                    <input type=\"radio\" name=\"radio" + i + "\" value='0'> <label for=\"radio" + i + "\">Non</label>\n" +
                        "                </fieldset>");
                }
                $('#formModal').append("<input type='hidden' name='nombreParticipant' id='nombreParticipant' value='" + i + "'>" +
                    "<button type='button' id='cloreCoursModal' onclick='clickCoursModal(" + numberForm + ")'> Cloturer le cours</button>");
                indexGen = i;
            });
            clickOpenBtnModal();
        });
    });
    <?php } ?>
</script>
