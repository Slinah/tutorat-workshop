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
            <input type='time' name='dateHeure' required value='" . $dateTimeFormatage->format("H:i:s"). "'>
            <label>heure</label>
            </div>";
            echo "<button type='submit'>Envoyer</button>
            </form>
            <form method='post' class='secondForm' action='/actions/actionsCloseCourse.php' id='formulaireCloseCourse" . $i . "'>
            <input type='input' required name='coursIntitule' value='" . $ligne->coursIntitule . "'>
            <input type='input' required name='matiereIntitule' value='" . $ligne->matiereIntitule . "'>
            <input type='input' required name='commentaires' value='" . $ligne->commentaires . "'>
            <input type='input' required name='promoIntitule' value='" . $ligne->promoIntitule . "'>
            <input type='input' required name='nbParticipants' value='" . $ligne->nbParticipants . "'>
            <input type='input' required step='0.1' name='duree' value='" . $ligne->duree . "'>
            <input type='input' required name='salle' value='" . $ligne->salle . "'>
            <input type='input' required name='id_cours' id='id_cours" . $i . "' value='" . $ligne->id_cours . "'>
            <input type='input' required name='id_personne' value='" . $ligne->id_personne . "'>
            <input type='input' required name='id_matiere' value='" . $ligne->id_matiere . "'>
            <input type='input' required name='id_promo' value='" . $ligne->id_promo . "'>
            <input type='input' required name='date' value='" . $dateTimeFormatage->format("Y-m-d") . "'>
            <input type='input' required name='dateHeure' value='" . $dateTimeFormatage->format("H:i:s") . "'>
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
            <form action="POST" id="formModal">

            </form>
        </div>
        <div class="closeButton" onclick="clickCloseBtnModal()">
            &cross;
        </div>
    </div>
</section>
<script src="/ressources/js/jquery.js"></script>
<script>
    var i = 0;

    function form2form(formA, formB) {
        $(':input[name]', formA).each(function () {
            console.log("form copie");
            $('[name=' + $(this).attr('name') + ']', formB).val($(this).val());
        })
    }

    function clickCoursModal(numberForm) {
        var infoPeople = [];
        console.log("i : " + i);
        for (var x = 0; x < i; x++) {

            if ($("input[name='radio" + x + "']:checked").val();) {
                infoPeople.push($("input[name='radio" + x + "']:checked").val());
            }
        }
        $("#nbParticipants" + numberForm).val(infoPeople.length);
        experience = Math.round($("#duree" + numberForm).val());
        idCourse = $("#id_cours" + numberForm).val();
        console.log('info');
        console.log(infoPeople);
        console.log(infoPeople.length);
        console.log('xp');
        console.log(experience);
        console.log('idCourse');
        console.log(idCourse);
        for (var y = 0; y <= infoPeople.length - 1; y++) {
            console.log('y');
            console.log(y);
            console.log("boucle");
            /*http_post("https://api.scratchoverflow.fr/api/experiencePeople", {
                "idPeople": infoPeople[y],
                "experience": experience,
                "idCourse": idCourse
            }).then(value => {
                if (y === (infoPeople.length)) {
                    form2form($("#formulaireModifyCourse<?php echo $i - 1 ?>"), $("#formulaireCloseCourse<?php echo $i - 1 ?>"));
                    $("#formulaireCloseCourse<?php echo $i - 1 ?>").submit();
                }
            });
            */

        }
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
            var idCours = $('input[name=id_cours]').val();
            // console.log(idCours);
            http_post("https://api.scratchoverflow.fr/api/listPeopleCourseById", {
                "idCourse": idCours
            }).then(value => {
                value = JSON.parse(value);
                console.log(value);
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
            });
            clickOpenBtnModal();
        });
    });
    <?php } ?>
</script>
