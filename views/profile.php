<?php

include_once "includes/composants/nav-bar.php";

if (isset($_SESSION['retourUser'])) {
    retourUtilisateur($_SESSION['retourUser']);
}

$dataUser = $_SESSION["me"];
//Récupérer les informations de la personne pour l'affichage du profil
$data = hpost('http://localhost:4567/api/personneById', array('idPersonne' => $dataUser->id_personne));
$experience = $data->experience;
//Récupérer les cours où je suis tuteur
$dataCoursesTutor = hpost('http://localhost:4567/api/peopleTutorCourseById', array('idPeople' => $dataUser->id_personne));
//Récupérer les cours où je suis inscrit
$dataCourses = hpost('http://localhost:4567/api/getRegisteredCourses', array('idPersonne' => $dataUser->id_personne));
//Récupérer les préférences
$dataPref = hpost('http://localhost:4567/api/getPreferenceById', array('idPersonne' => $dataUser->id_personne));
$dataPref = $dataPref[0];

$timeZone = new DateTimeZone("Europe/Paris");
$dateTime = new DateTime("now", $timeZone);
$moisActuel = (int)date("m", $dateTime->getTimestamp());

?>
<section class="headerTitle" id="profil">
    <h2>Profil</h2>
    <form action="/actions/actionsDeconnexion.php">
        <div id="btnDeconnexion">
            <button type="submit">Déconnexion</button>
        </div>
    </form>
</section>
<section id="profilSection">
    <div>
        <?php if ($data->image != null) { ?>
            <img src="<?= $data->image ?>"
                 width="100" height="100" alt="base64 test">
        <?php } ?>
        <?php if ($data->role == 1) {
            echo "<h2 style='color: red'>Administrateur</h2>";
        } ?>
        <h2><?= $data->nom ?></h2>
        <h2><?= $data->prenom ?></h2>
        <h2><?= $data->mail ?></h2>
        <h2><?= $data->intitulePromo ?></h2>
        <h2><?= $data->intituleClasse ?></h2>
        <h2>Expérience : <?= $data->experience ?></h2>
        <div id="niveau">Niveau :</div>
        <input type="hidden" id="experience" value="<?= $data->experience ?>">
    </div>
    <div class="exp">
        <div class="experienceContainer">
            <div class="whiteBack">
                <div id="experienceColor"></div>
            </div>
        </div>
    </div>
    <div>(Tu gagnes 1 point d'expérience pour 1h de présence en tutorat,
        <br>Tous les 10 points d'expériences tu  augmentes d'un niveau !)
    </div>
</section>
<section class="headerTitle">
    <h2>Mes cours</h2>
</section>
<section class="cardContainer">
    <?php
    if (property_exists((object)$dataCoursesTutor, "error")) {
        echo "<section class='card'>
<header>Tu n'as pas créé de cours.</header>
</section>";
    } else {
        foreach ($dataCoursesTutor as $dataCourseTutor) { ?>
            <section class="card">
                <header><?= $dataCourseTutor->coursIntitule ?></header>
                <p><?= $dataCourseTutor->commentaires ?></p>
                <button type="button" onclick="document.location.href='/tuteur-cours'">Modifier</button>
                <div class="classeUpLeft"><?= $dataCourseTutor->promoIntitule ?></div>
                <div class="dateUpRight"><?= date("d / m / y", strtotime($dataCourseTutor->date)); ?></div>
                <div class="salleDownLeft"><?= $dataCourseTutor->salle ?></div>
            </section>
            <?php
        }
    } ?>
</section>
<section class="headerTitle">
    <h2>Les cours où je suis inscrit</h2>
</section>
<section class="cardContainer">
    <?php
    if (property_exists((object)$dataCourses, "error")) {
        echo "<section class='card'>
<header>tu es inscrit sur aucun cours.</header>
</section>";
    } else {
        foreach ($dataCourses as $dataCourse) { ?>
            <section class="card">
                <header><?= $dataCourse->intituleCours ?></header>
                <p><?= $dataCourse->commentaires ?></p>
                <form id="<?= 'actionDeregister_' . $dataCourse->id_cours ?>"
                      action="/actions/actionsDeregisterCourse.php" method="post">
                    <input id="idPersonneForDeregister" name="idPersonne" type="hidden"
                           value="<?= $dataUser->id_personne ?>">
                    <input id="idCoursForDeregister" name="idCours" type="hidden" value="<?= $dataCourse->id_cours ?>">
                    <?php
                    echo "<button type='button' onclick=\"btnClickDeregisterCourse('" . $dataCourse->intituleCours . "','" . $dataCourse->id_cours . "')\">Se désinscrire</button>"
                    ?>
                </form>
                <div class="classeUpLeft"><?= $dataCourse->intitulePromo ?></div>
                <div class="dateUpRight"><?= date("d / m / y", strtotime($dataCourse->date)); ?></div>
                <div class="salleDownLeft"><?= $dataCourse->salle ?></div>
            </section>
        <?php }
    } ?>
</section>
<section class="headerTitle">
    <h2>Tes préférences !</h2>
</section>
<?php $level = 0;
    for ($x = 0; $x < $experience; $x++) {
        if ($x % 10 === 0) {
            $level++;
        }
    } ?>
<section class="login-box">
    <form method="post" action="/actions/actionsModifyPreferences.php">
        <?php if($level>=0){
// ------------------------------------ Zone Niveau classique 0 - 200 -----------------------------------------
//            Cursor Set lvl 0-1 dans cette zone
            ?>
            <div class="user-box">
                <input type="radio" name="radioPref" value="1" <?php if($dataPref->curseur_id ===1){echo"checked";}?>>
                <img src="../ressources/img/cursors/cursorLogoElephant.png" alt="curseur ">
            </div>
            <div class="user-box">
                <input type="radio" name="radioPref" value="2" <?php if($dataPref->curseur_id ===2){echo"checked";}?>>
                <img src="../ressources/img/cursors/cursorScratch.png" alt="curseur">
            </div>
            <div class="user-box">
                <input type="radio" name="radioPref" value="3" <?php if($dataPref->curseur_id ===3){echo"checked";}?>>
                <img src="../ressources/img/cursors/cursorScratchBlue.png" alt="curseur">
            </div>
            <?php
        } ?>
        <?php if($level>=2){
//            Cursor Set lvl 2 dans cette zone
            ?>
            <div class="user-box">
                <input type="radio" name="radioPref" value="4" <?php if($dataPref->curseur_id ===4){echo"checked";}?>>
                <img src="../ressources/img/cursors/cursorPoussin.png" alt="curseur">
            </div>
            <?php
        } ?>
        <?php if($level>=3){
//            Cursor Set lvl 3 dans cette zone
            ?>
            <div class="user-box">
                <input type="radio" name="radioPref" value="5" <?php if($dataPref->curseur_id ===5){echo"checked";}?>>
                <img src="../ressources/img/cursors/cursorCerf.png" alt="curseur">
            </div>
            <?php
        } ?>
        <?php if($level>=4){
//            Cursor Set lvl 4 dans cette zone
            ?>
            <div class="user-box">
                <input type="radio" name="radioPref" value="6" <?php if($dataPref->curseur_id ===6){echo"checked";}?>>
                <img src="../ressources/img/cursors/cursorPiaf.png" alt="curseur">
            </div>
            <?php
        } ?>
        <?php if($level>=5){
//            Cursor Set lvl 5 dans cette zone
            ?>
            <div class="user-box">
                <input type="radio" name="radioPref" value="7" <?php if($dataPref->curseur_id ===7){echo"checked";}?>>
                <img src="../ressources/img/cursors/cursorPoulet.png" alt="curseur">
            </div>
            <?php
        } ?>
        <?php if($level>=6){
//            Cursor Set lvl 10 dans cette zone
            ?>
            <div class="user-box">
                <input type="radio" name="radioPref" value="8" <?php if($dataPref->curseur_id ===8){echo"checked";}?>>
                <img src="../ressources/img/cursors/cursorBee.png" alt="curseur">
            </div>
            <?php
        } ?>
        <?php if($level>=7){
//            Cursor Set lvl 10 dans cette zone
            ?>
            <div class="user-box">
                <input type="radio" name="radioPref" value="9" <?php if($dataPref->curseur_id ===9){echo"checked";}?>>
                <img src="../ressources/img/cursors/cursorVache.png" alt="curseur">
            </div>
            <?php
        } ?>
        <?php if($level>=10){
//            Cursor Set lvl 10 dans cette zone
            ?>
            <div class="user-box">
                <input type="radio" name="radioPref" value="10" <?php if($dataPref->curseur_id ===10){echo"checked";}?>>
                <img src="../ressources/img/cursors/cursorElephant.png" alt="curseur">
            </div>
            <?php
        } ?>
        <?php
// ------------------------------------ Zone Groupes 200 - 400 -----------------------------------------
        if(strtoupper($data->ecole) === 'EPSI'){
//            Cursor Set 200 dans cette zone - Epsi
            ?>
            <div class="user-box">
                <input type="radio" name="radioPref" value="200" <?php if($dataPref->curseur_id ===200){echo"checked";}?>>
                <img src="../ressources/img/cursors/cursorEpsi.png" alt="curseur">
            </div>
            <?php
        } ?>
        <?php
        if(strtoupper($data->ecole) === 'WIS'){
//            Cursor Set 201 dans cette zone - Wis
            ?>
            <div class="user-box">
                <input type="radio" name="radioPref" value="201" <?php if($dataPref->curseur_id ===201){echo"checked";}?>>
                <img src="../ressources/img/cursors/cursorWis.png" alt="curseur">
            </div>
            <?php
        } ?>
        <?php
        if(strtoupper($data->intitulePromo) === 'B2'){
//            Cursor Set 202 dans cette zone - B2
            ?>
            <div class="user-box">
                <input type="radio" name="radioPref" value="202" <?php if($dataPref->curseur_id ===202){echo"checked";}?>>
                <img src="../ressources/img/cursors/cursorPumbaa.png" alt="curseur">
            </div>
            <?php
        } ?>
        <?php

//            Cursor Set 203 dans cette zone - BDE
            ?>
            <div class="user-box">
                <input type="radio" name="radioPref" value="203" <?php if($dataPref->curseur_id ===203){echo"checked";}?>>
                <img src="../ressources/img/cursors/cursorBde.png" alt="curseur">
            </div>
        <?php
        // ------------------------------------ Zone Evenements 400 - 600 -----------------------------------------
        $nom=strtoupper($data->nom);
        if($nom === 'CATIFAIT' || $nom === 'BARITEAU' || $nom === 'GAUTHIER' || $nom === 'LE FLOCH' || $nom === 'CINQUIN' || $nom === 'MENANTEAU' || $nom === 'DEZETTRE'){
//            Cursor Set 400 dans cette zone - Développement V2 Tutorat
            ?>
            <div class="user-box">
                <input type="radio" name="radioPref" value="400" <?php if($dataPref->curseur_id ===400){echo"checked";}?>>
                <img src="../ressources/img/cursors/cursorScratchRainbow.png" alt="curseur">
            </div>
            <?php
        } ?>
        <?php
        if($moisActuel===10){
        //            Cursor Set 401 - Spider - Halloween
        ?>
            <div class="user-box">
                <input type="radio" name="radioPref" value="401" <?php if($dataPref->curseur_id ===401){echo"checked";}?>>
                <img src="../ressources/img/cursors/cursorSpider.png" alt="curseur">
            </div>

            <div class="user-box">
                <input type="radio" name="radioPref" value="402" <?php if($dataPref->curseur_id ===402){echo"checked";}?>>
                <img src="../ressources/img/cursors/cursorHalloween.png" alt="curseur">
            </div>
        <?php
        } ?>
        <?php
        // ------------------------------------ Zone Spéciale 600+ -----------------------------------------
        ?>
        <?php
        if($nom === 'DEZETTRE'){
        //            Cursor Set 600 - Priscillia
        ?>
        <div class="user-box">
            <input type="radio" name="radioPref" value="600" <?php if($dataPref->curseur_id ===600){echo"checked";}?>>
            <img src="../ressources/img/cursors/cursorPriscillia.png" alt="curseur">
        </div>
        <?php
        } ?>
        <?php
        if($nom === 'MENANTEAU'){
        //            Cursor Set 601 - Cédric
        ?>
        <div class="user-box">
            <input type="radio" name="radioPref" value="601" <?php if($dataPref->curseur_id ===601){echo"checked";}?>>
            <img src="../ressources/img/cursors/cursorCedric.png" alt="curseur">
        </div>
        <?php
        } ?>
        <?php
        if($nom === 'CATIFAIT'){
//            Cursor Set 602 - Léo
            ?>
            <div class="user-box">
                <input type="radio" name="radioPref" value="602" <?php if($dataPref->curseur_id ===602){echo"checked";}?>>
                <img src="../ressources/img/cursors/cursorLelito.png" alt="curseur">
            </div>
            <?php
        } ?>
        <?php
        if($nom === 'BARITEAU'){
//            Cursor Set 603 - Marion
            ?>
            <div class="user-box">
                <input type="radio" name="radioPref" value="603" <?php if($dataPref->curseur_id ===603){echo"checked";}?>>
                <img src="../ressources/img/cursors/cursorMayon.png" alt="curseur">
            </div>
            <?php
        } ?>
        <?php
        if($nom === 'GAUTHIER'){
//            Cursor Set 604 - Mathis
            ?>
            <div class="user-box">
                <input type="radio" name="radioPref" value="604" <?php if($dataPref->curseur_id ===604){echo"checked";}?>>
                <img src="../ressources/img/cursors/cursorMathis.png" alt="curseur">
            </div>
            <?php
        } ?>
        <?php
        if($nom === 'LE FLOCH'){
//            Cursor Set 605 - Breval
            ?>
            <div class="user-box">
                <input type="radio" name="radioPref" value="605" <?php if($dataPref->curseur_id ===605){echo"checked";}?>>
                <img src="../ressources/img/cursors/cursorScratchHuberflow.png" alt="curseur">
            </div>
            <?php
        } ?>
        <?php
        if($nom === 'CINQUIN'){
//            Cursor Set 606 - Andy
            ?>
            <div class="user-box">
                <input type="radio" name="radioPref" value="606" <?php if($dataPref->curseur_id ===606){echo"checked";}?>>
                <img src="../ressources/img/cursors/cursorAndy.png" alt="curseur">
            </div>
            <?php
        } ?>
        <br>
        <input type="hidden" name="idPersonne" value="<?php echo ($dataUser->id_personne) ?>">
        <button type="submit">Changer le curseur</button>
    </form>
</section>
<script>
    var exp = document.getElementById("experience");
    exp = exp.value;
    var level = 0;
    for (var x = 0; x < exp; x++) {
        if (x % 10 === 0) {
            level++;
        }
    }
    var barreXp = document.getElementById("experienceColor");
    barreXp.style.width = ((exp % 10) * 10).toString() + "%";
    var niveau = document.getElementById("niveau");
    niveau.innerHTML += level.toString();
    niveau.innerHTML += " (" + ((exp % 10) * 10).toString() + "%)";
</script>
