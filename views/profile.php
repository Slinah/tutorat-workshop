<?php

include_once "includes/composants/nav-bar.php";

//todo gestion des retours ?


if (isset($_SESSION['retourUser'])) {
    retourUtilisateur($_SESSION['retourUser']);
}

$dataUser = $_SESSION["me"];
//Récupérer les informations de la personne pour l'affichage du profil
$data = hpost('http://localhost:4567/api/personneById', array('idPersonne' => $dataUser->id_personne));
//Récupérer les cours où je suis tuteur
$dataCoursesTutor = hpost('http://localhost:4567/api/getOwnCourses', array('idPersonne' => $dataUser->id_personne));
//Récupérer les cours où je suis inscrit
$dataCourses = hpost('http://localhost:4567/api/getRegisteredCourses', array('idPersonne' => $dataUser->id_personne));
?>

<!--TODO corrigé l'espace en CSS car le titre profil passe sous la navbar-->

<section class="headerTitle">
    <h2>Profil</h2>
</section>
<?php var_dump($data); ?>
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
        <h2>(Vous gagnez 1 d'expérience pour 1h de présence en tutorat,
            <br>Tous les 10 points d'expéreinces vous gagnez un niveau !)</h2>
        <h2>Expérience : <?= $data->experience ?></h2>
            <div id="niveau">Niveau : </div>

        <input type="hidden" id="experience" value="<?= $data->experience ?>">
    </div>
    <div class="exp">
        <div class="experienceContainer">
            <div class="whiteBack">
                <div id="experienceColor"></div>
            </div>
        </div>
    </div>
</section>
<section class="headerTitle">
    <h2>Mes cours</h2>
</section>
<section class="cardContainer">
    <?php
    if (isset($dataCoursesTutor)) {
        echo "<section class='card'>
<header>Vous n'avez pas créer de cours.</header>
</section>";
    } else {
        foreach ($dataCoursesTutor as $dataCourseTutor) { ?>
            <section class="card">
                <header><?= $dataCourseTutor->intituleCours ?></header>
                <p><?= $dataCourseTutor->commentaires ?></p>
                <button type="button">Modifier</button>
                <div class="classeUpLeft"><?= $dataCourseTutor->intitulePromo ?></div>
                <div class="dateUpRight"><?= date("d / m / y", strtotime($dataCourseTutor->date)); ?></div>
                <div class="salleDownLeft"><?= $dataCourseTutor->salle ?></div>
                <div class="wifiDownRight"><i class="fas fa-wifi"></i></div>
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
    if (isset($dataCourses->error)) {
        echo "<section class='card'>
<header>Vous êtes inscrit sur aucun cours.</header>
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
                <div class="wifiDownRight"><i class="fas fa-wifi"></i></div>
            </section>
        <?php }
    } ?>
</section>
<script>
    var exp = document.getElementById("experience");
    exp=exp.value;
    var level=0;
    for(var x=0;x<exp;x++){
        if(x%10===0){
            level++;
        }
    }
    var barreXp = document.getElementById("experienceColor");
    barreXp.style.width=((exp%10)*10).toString()+"%";
    var niveau = document.getElementById("niveau");
    niveau.innerHTML+=level.toString();
    niveau.innerHTML+=" ("+((exp%10)*10).toString()+"%)";
</script>
