<?php

//include_once "includes/composants/nav-bar.php";

//TODO à enlever quand la page de connexion sera dispo
$_SESSION["role"] = 1;

if (!isset($_SESSION["role"]) || ($_SESSION["role"] != 1)) {
//    Redirigé sur une autre page
}


//TODO requête API à sécurisé avec Token
//TODO URI à changer quand mise en production
$dataUsers = hget("http://localhost:4567/api/getAllUsers");
$dataSubjects = hget('http://localhost:4567/api/getAllSubjects');
$dataSchools = hget('http://localhost:4567/api/getAllSchools');
$dataPromosFromSchools = hget('http://localhost:4567/api/getPromoFromSchool');
$dataClassesFromPromos = hget('http://localhost:4567/api/getClassFromPromo');
$dataLevels = hget('http://localhost:4567/api/getLevel');
?>

<!--        todo liens (onclick) js sur tous les buttons / envoie des données dans un formulaire etc -->
<!-- Nav Bar -->
<div class="login-box">
    <h2>Gestion des utilisateurs</h2>

    <div class="user-box">
        <select name="personneSelect" id="personne-select">
            <option value="" selected>NOM - Prenom - Ecole - Promo - Classe - Role</option>
            <?php foreach ($dataUsers as $dataUser) { ?>
                <option value="<?= $dataUser->id_personne ?>"><?= $dataUser->nom . ' - ' . $dataUser->prenom . ' - ' .
                    $dataUser->intituleEcole . ' - ' . $dataUser->intitulePromo . ' - ' . $dataUser->intituleClass . ' - Role : ' . $dataUser->role ?></option>
            <?php } ?>
        </select>
    </div>
    <!--        TODO Action à faire pour les boutons + Requêtes API nécessaire-->

    <form action="/actions/actionsPromoteUser.php" method="post">
        <input type="hidden" id="idUserPromote" name="idUser" value="">
        <button type="submit" id="btnPromoteUser">
            Promote
        </button>
    </form>
    <form action="/actions/actionsDemoteUser.php" method="post">
        <input type="hidden" id="idUserDemote" name="idUser" value="">
        <button type="submit" id="btnDemoteUser">
            Demote
        </button>
    </form>
    <form action="/actions/actionsDeleteUser.php" method="post">
        <input type="hidden" id="idUserDelete" name="idUser" value="">
        <button type="submit" id="btnDeleteUser">
            Supprimer le compte
        </button>
    </form>

</div>

<div class="login-box">
    <h2>Gestion des matières</h2>
    <form action="/actions/actionsDeleteSubject.php" method="post">
        <div class="user-box">
            <select name="matiereSelect" id="matiere-select">
                <option value="" selected>Liste matière</option>
                <?php foreach ($dataSubjects as $dataSubject) { ?>
                    <option value="<?= $dataSubject->id_matiere ?>"><?= 'Matière : ' . $dataSubject->intitule . ' - Validation : ' . $dataSubject->validationAdmin ?></option>
                <?php } ?>
            </select>
        </div>
        <input type="hidden" id="idDeleteSubject" name="idDeleteSubject" value="">
        <button type="submit" id="btnDeleteSubject">
            Supprimer matière
        </button>
    </form>
    <form action="/actions/actionsAddSubject.php" method="post">
        <div class="user-box">
            <input type="text" id="addSubject" name="addSubject" required>
            <label>Nom de la matière à ajouter</label>
        </div>
        <button type="submit" id="btnAddSubject">
            Ajout matière
        </button>
    </form>
</div>

<div class="login-box">
    <h2>Gestion des Ecoles</h2>

    <div class="user-box">
        <select name="ecoleSelect" id="ecole-select">
            <option value="" selected>Liste école</option>
            <?php foreach ($dataSchools as $dataSchool) { ?>
                <option value="<?= $dataSchool->id_ecole ?>"><?= $dataSchool->intitule ?></option>
            <?php } ?>
        </select>
    </div>
    <form action="/actions/actionsDeleteSchool.php" method="post">
        <input type="hidden" id="idDeleteSchool" name="idDeleteSchool">
        <button type="submit" id="btnDeleteSchool">
            Supprimer Ecole
        </button>
    </form>
    <form action="/actions/actionsAddSchool.php" method="post">
        <div class="user-box">
            <input type="text" name="addSchool" required>
            <label>Nom de l'école à ajouter</label>
        </div>
        <button type="submit">
            Ajout Ecole
        </button>
    </form>
</div>

<div class="login-box">
    <h2>Gestion des Promos</h2>

    <div class="user-box">
        <select name="ecoleSelect" id="ecole-select2">
            <option value="" selected>Liste ecole</option>
            <?php foreach ($dataSchools as $dataSchool) { ?>
                <option value="<?= $dataSchool->id_ecole ?>"><?= $dataSchool->intitule ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="user-box">
        <select name="promoSelect" id="promo-select" disabled>
            <option value="" id="show1" selected>Liste Promo</option>
            <?php foreach ($dataPromosFromSchools as $dataPromosFromSchool) { ?>
                <option value="<?= $dataPromosFromSchool->id_promo ?>"
                        class="<?= 'ec_' . $dataPromosFromSchool->id_ecole ?>"><?= $dataPromosFromSchool->intitulePromo ?></option>
            <?php } ?>
        </select>
    </div>
    <form action="/actions/actionsDeletePromo.php" method="post">
        <input type="hidden" id="idDeletePromo" name="idDeletePromo">
        <button type="submit" id="btnDeletePromo">
            Supprimer promo
        </button>
    </form>
    <form action="/actions/actionsAddPromo.php" method="post">
        <div class="user-box">
            <input type="hidden" id="idSchoolForAddPromo" name="idSchool" value="">
            <input type="text" id="idAddPromo" name="addPromo" required disabled="disabled">
            <label>Nom de la promo à ajouter</label>
        </div>
        <button type="submit" id="btnAddPromo">
            Ajout promo
        </button>
    </form>
</div>

<div class="login-box">
    <h2>Gestion des classes</h2>

    <div class="user-box">
        <select name="ecoleSelect" id="ecole-select3">
            <option value="" selected>Liste ecole</option>
            <?php foreach ($dataSchools as $dataSchool) { ?>
                <option value="<?= $dataSchool->id_ecole ?>"><?= $dataSchool->intitule ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="user-box">
        <select name="promoSelect" id="promo-select2" disabled>
            <option value="" id="show2" selected>Liste Promo</option>
            <?php foreach ($dataPromosFromSchools as $dataPromosFromSchool) { ?>
                <option value="<?= $dataPromosFromSchool->id_promo ?>"
                        class="<?= 'ec_' . $dataPromosFromSchool->id_ecole ?>"><?= $dataPromosFromSchool->intitulePromo ?></option>
            <?php } ?>

        </select>
    </div>
    <div class="user-box">
        <select name="promoSelect" id="classe-select" disabled>
            <option value="" id="show3" selected>Liste classe</option>
            <?php foreach ($dataClassesFromPromos as $dataClassesFromPromo) { ?>
                <option value="<?= $dataClassesFromPromo->id_classe ?>"
                        class="<?= 'pro_' . $dataClassesFromPromo->id_promo ?>"><?= $dataClassesFromPromo->intituleClasse ?></option>
            <?php } ?>
        </select>
    </div>
    <form action="/actions/actionsDeleteClasse.php" method="post">
        <input type="hidden" id="idDeleteClasse" name="idDeleteClasse">
        <button type="submit" id="btnDeleteClasse">
            Supprimer classe
        </button>
    </form>
    <form action="/actions/actionsAddClasse.php" method="post">
    <div class="user-box">
        <input type="hidden" id="idSchoolForPromo2" name="idSchool">
        <input type="hidden" id="idPromoForClasse" name="idPromo">
        <input type="text" id="addClasse" name="addClasse" required>
        <label>Nom de la classe à ajouter</label>
    </div>
    <button type="submit" id="btnAddClasse">
        Ajout classe
    </button>
    </form>
</div>

<div class="login-box">
    <h2>Gestion des niveaux</h2>

        <div class="user-box">
            <select name="niveauSelect" id="niveau-select">
                <option value="" selected>Liste niveau</option>
                <?php foreach ($dataLevels as $dataLevel) { ?>
                    <option value="<?= $dataLevel->id_niveau ?>"><?= $dataLevel->intitule ?></option>
                <?php } ?>
            </select>
        </div>
    <form action="/actions/actionsDeleteLevel.php" method="post">
        <input type="hidden" id="idDeleteLevel" name="idDeleteLevel">
        <button type="submit" id="btnDeleteLevel">
            Supprimer niveau
        </button>
    </form>
    <form action="/actions/actionsAddLevel.php" method="post">
        <div class="user-box">
            <input type="text" name="addLevel" required>
            <label>Niveau à ajouter</label>
        </div>
        <button type="submit" id="btnAddLevel">
            Ajout niveau
        </button>
    </form>
</div>
<!--TODO Jquery pour les selecteurs (lié ecole/promo/classe)-->


