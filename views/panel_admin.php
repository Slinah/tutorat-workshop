<?php
//todo gestion des retours ?
//include_once "includes/composants/nav-bar.php";

//TODO requête API à sécurisé avec Token
//TODO URI à changer quand mise en production
// Todo gestion de l'affichage des erreurs ?
$dataUsers = hget("http://localhost:4567/api/getAllUsers");
if(property_exists((object)$dataUsers, "error")){
    $dataUsers=null;
}
$dataSubjects = hget('http://localhost:4567/api/getAllSubjects');
if(property_exists((object)$dataSubjects, "error")){
    $dataSubjects=null;
}
$dataSchools = hget('http://localhost:4567/api/getAllSchools');
if(property_exists((object)$dataSchools, "error")){
    $dataSchools=null;
}
$dataPromosFromSchools = hget('http://localhost:4567/api/getPromoFromSchool');
if(property_exists((object)$dataPromosFromSchools, "error")){
    $dataPromosFromSchools=null;
}
$dataClassesFromPromos = hget('http://localhost:4567/api/getClassFromPromo');
if(property_exists((object)$dataClassesFromPromos, "error")){
    $dataClassesFromPromos=null;
}
$dataLevels = hget('http://localhost:4567/api/getLevel');
if(property_exists((object)$dataLevels, "error")){
    $dataLevels=null;
}
if (isset($_SESSION['retourUser'])) {
    retourUtilisateur($_SESSION['retourUser']);
}
?>

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
    <form id="actionPromoteUser" action="/actions/actionsPromoteUser.php" method="post">
        <input type="hidden" id="idUserPromote" name="idUser" value="">
        <button type="button" id="btnPromoteUser" onclick="btnClickPromote()">
            Promote
        </button>
    </form>
    <form  id="actionDemoteUser" action="/actions/actionsDemoteUser.php" method="post">
        <input type="hidden" id="idUserDemote" name="idUser" value="">
        <button type="button" id="btnDemoteUser" onclick="btnClickDemote()">
            Demote
        </button>
    </form>
    <form id="actionDelAccount" action="/actions/actionsDeleteUser.php" method="post">
        <input type="hidden" id="idUserDelete" name="idUser" value="">
        <button type="button" id="btnDeleteUser" onclick="btnClickDelete('compte', 'actionDelAccount')">
            Supprimer le compte
        </button>
    </form>
</div>

<div class="login-box">
    <h2>Gestion des matières</h2>

        <div class="user-box">
            <select name="matiereSelect" id="matiere-select">
                <option value="" selected>Liste matière</option>
                <?php foreach ($dataSubjects as $dataSubject) { ?>
                    <option value="<?= $dataSubject->id_matiere ?>"><?= $dataSubject->intitule . ' - Validation : ' . $dataSubject->validationAdmin ?></option>
                <?php } ?>
            </select>
        </div>
    <form action="/actions/actionsValidateSubject.php" method="post">
        <input type="hidden" id="idValidateSubject" name="idValidateSubject">
        <button type="submit" id="btnValidateSubject">
            Valider matière
        </button>
    </form>
    <form id="actionDelSubject" action="/actions/actionsDeleteSubject.php" method="post">
        <input type="hidden" id="idDeleteSubject" name="idDeleteSubject" value="">
        <button type="button" id="btnDeleteSubject" onclick="btnClickDelete('matière', 'actionDelSubject')">
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
    <form id="actionDelSchool" action="/actions/actionsDeleteSchool.php" method="post">
        <input type="hidden" id="idDeleteSchool" name="idDeleteSchool">
        <button type="button" id="btnDeleteSchool" onclick="btnClickDelete('école', 'actionDelSchool')">
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
    <form id="actionDelPromo" action="/actions/actionsDeletePromo.php" method="post">
        <input type="hidden" id="idDeletePromo" name="idDeletePromo">
        <button type="button" id="btnDeletePromo" onclick="btnClickDelete('promotion', 'actionDelPromo')">
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
    <form id="actionDelClasse" action="/actions/actionsDeleteClasse.php" method="post">
        <input type="hidden" id="idDeleteClasse" name="idDeleteClasse">
        <button type="button" id="btnDeleteClasse" onclick="btnClickDelete('classe', 'actionDelClasse')">
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
    <form id="actionDelLevel" action="/actions/actionsDeleteLevel.php" method="post">
        <input type="hidden" id="idDeleteLevel" name="idDeleteLevel">
        <button type="button" id="btnDeleteLevel" onclick="btnClickDelete('niveau', 'actionDelLevel')">
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
