<?php
//include_once "includes/composants/nav-bar.php";
//unset($_SESSION['me']);
/*
//$idPersonne = $_SESSION["me"]->id_personne;
$idPersonne = '397f0069-3bac-440c-b564-6ed241bc9b2d';
//Récupérer les informations de la personne pour l'affichage du profil
$data = hpost('http://localhost:4567/api/personneById', array('idPersonne' => $idPersonne));
//Récupérer les cours où je suis tuteur
$dataCoursesTutor = hpost('http://localhost:4567/api/getOwnCourses', array('idPersonne' => $idPersonne));
//Récupérer les cours où je suis inscrit
$dataCourses = hpost('http://localhost:4567/api/getRegisteredCourses', array('idPersonne' => $idPersonne));
?>

<!--TODO corrigé l'espace en CSS car le titre profil passe sous la navbar-->
<section class="headerTitle">
    <h2>.</h2>
</section>

<section class="headerTitle">
    <h2>Profil</h2>
</section>
<section id="profilSection">
    <div>
        <?php if ($data[0]->image != null) { ?>
            <img src="<?= $data[0]->image ?>"
                 width="100" height="100" alt="base64 test">
        <?php } ?>
        <?php if ($data[0]->role == 1) {
            echo "<h2 style='color: red'>Administrateur</h2>";
        } ?>
        <h2><?= $data[0]->nom ?></h2>
        <h2><?= $data[0]->prenom ?></h2>
        <h2><?= $data[0]->mail ?></h2>
        <h2><?= $data[0]->intitulePromo ?></h2>
        <h2><?= $data[0]->intituleClasse ?></h2>
        <h2>Expérience :</h2>
    </div>
    <div class="exp">
        <div class="experienceContainer">
            <div class="whiteBack">
                <!--TODO changer dynamiquement cette barre en fonction de la progression dans le niveau ?-->
                <div id="experienceColor"></div>
            </div>
        </div>
    </div>
</section>
<section class="headerTitle">
    <h2>Mes cours</h2>
</section>
<section class="cardContainer">
    <?php foreach ($dataCoursesTutor as $dataCourseTutor) { ?>
        <section class="card">
            <header><?= $dataCourseTutor->intituleCours ?></header>
            <p><?= $dataCourseTutor->commentaires ?></p>
            <button type="button">Modifier</button>
            <div class="classeUpLeft"><?= $dataCourseTutor->intitulePromo ?></div>
            <div class="dateUpRight"><?= date("d / m / y", strtotime($dataCourseTutor->date)); ?></div>
            <!--TODO css pour salleDownLeft-->
            <div class="salleDownLeft"><?= $dataCourseTutor->salle ?></div>
            <div class="wifiDownRight"><i class="fas fa-wifi"></i></div>
        </section>
    <?php } ?>
</section>
<section class="headerTitle">
    <h2>Les cours où je suis inscrit</h2>
</section>
<section class="cardContainer">
    <?php foreach ($dataCourses as $dataCourse) { ?>
        <section class="card">
            <header><?= $dataCourse->intituleCours ?></header>
            <p><?= $dataCourse->commentaires ?></p>
            <button type="button">Se désinscrire</button>
            <div class="classeUpLeft"><?= $dataCourse->intitulePromo ?></div>
            <div class="dateUpRight"><?= date("d / m / y", strtotime($dataCourse->date)); ?></div>
            <!--TODO css pour salleDownLeft-->
            <div class="salleDownLeft"><?= $dataCourse->salle ?></div>
            <div class="wifiDownRight"><i class="fas fa-wifi"></i></div>
        </section>
    <?php } ?>
</section>
