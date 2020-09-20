<?php
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
    <h2>.</h2>
</section>
<section class="headerTitle">
    <h2>Profil</h2>
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
    <?php
    if (empty($dataCoursesTutor)) {
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
    if (empty($dataCourses)) {
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
