<?php

//include_once "includes/composants/nav-bar.php";

//TODO à enlever quand la page de connexion sera dispo
$_SESSION["role"] = 1;

if (!isset($_SESSION["role"]) || ($_SESSION["role"] != 1)){
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
    <form>
        <div class="user-box">
            <select name="personneSelect" id="personne-select">
                <option value="">NOM - Prenom - Ecole - Promo - Classe - Role</option>
                <?php foreach($dataUsers as $dataUser){ ?>
                    <option value="<?= $dataUser->id_personne ?>"><?= $dataUser->nom .' - '. $dataUser->prenom .' - '.
                        $dataUser->intituleEcole .' - '. $dataUser->intitulePromo .' - '. $dataUser->intituleClass .' - Role : '. $dataUser->role ?></option>
                <?php } ?>
            </select>
        </div>
<!--        TODO Action à faire pour les boutons + Requêtes API nécessaire-->
        <a href="#">
            Promote
        </a>
        <a href="#">
            Demote
        </a>
        <a href="#">
            Supprimer le compte
        </a>
    </form>
</div>

<div class="login-box">
    <h2>Gestion des matières</h2>
    <form>
        <div class="user-box">
            <select name="matiereSelect" id="matiere-select">
                <option value="">Liste matière</option>
                <?php foreach($dataSubjects as $dataSubject){ ?>
                <option value="<?= $dataSubject->id_matiere ?>"><?= 'Matière : '. $dataSubject->intitule .' - Validation : '. $dataSubject->validationAdmin ?></option>
                <?php } ?>
            </select>
        </div>
        <a href="#">
            Supprimer maière
        </a>
        <div class="user-box">
            <input type="text" name="" required>
            <label>Nom de la matière à ajouter</label>
        </div>
        <a href="#">
            Ajout matière
        </a>
    </form>
</div>

<div class="login-box">
    <h2>Gestion des Ecoles</h2>
    <form>
        <div class="user-box">
            <select name="ecoleSelect" id="ecole-select">
                <option value="">Liste école</option>
                <?php foreach($dataSchools as $dataSchool){ ?>
                <option value="<?= $dataSchool->id_ecole ?>"><?= $dataSchool->intitule ?></option>
                <?php } ?>
            </select>
        </div>
        <a href="#">
            Supprimer Ecole
        </a>
        <div class="user-box">
            <input type="text" name="" required>
            <label>Nom de l'école à ajouter</label>
        </div>
        <a href="#">
            Ajout Ecole
        </a>
    </form>
</div>

<div class="login-box">
    <h2>Gestion des Promos</h2>
    <form>
        <div class="user-box">
            <select name="ecoleSelect" id="ecole-select2">
                <option value="">Liste ecole</option>
                <?php foreach($dataSchools as $dataSchool){ ?>
                    <option value="<?= $dataSchool->id_ecole ?>"><?= $dataSchool->intitule ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="user-box">
            <select name="promoSelect" id="promo-select">
                <option value="">Liste Promo</option>
                <?php foreach($dataPromosFromSchools as $dataPromosFromSchool){ ?>
                <option value="<?= $dataPromosFromSchool->id_promo ?>" class="<?= 'ec_'.$dataPromosFromSchool->id_ecole ?>"><?= $dataPromosFromSchool->intitulePromo ?></option>
                <?php } ?>
            </select>
        </div>
        <a href="#">
            Supprimer promo
        </a>
        <div class="user-box">
            <input type="text" name="" required>
            <label>Nom de la promo à ajouter</label>
        </div>
        <a href="#">
            Ajout promo
        </a>
    </form>
</div>

<div class="login-box">
    <h2>Gestion des classes</h2>
    <form>
        <div class="user-box">
            <select name="ecoleSelect" id="ecole-select3">
                <option value="">Liste ecole</option>
                <?php foreach($dataSchools as $dataSchool){ ?>
                <option value="<?= $dataSchool->id_ecole ?>"><?= $dataSchool->intitule ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="user-box">
            <select name="promoSelect" id="promo-select2">
                <option value="">Liste Promo</option>
                <?php foreach($dataPromosFromSchools as $dataPromosFromSchool){ ?>
                <option value="<?= $dataPromosFromSchool->id_promo ?>" class="<?= $dataPromosFromSchool->id_ecole ?>"><?= $dataPromosFromSchool->intitulePromo ?></option>
                <?php } ?>

            </select>
        </div>
        <div class="user-box">
            <select name="promoSelect" id="classe-select">
                <option value="">Liste classe</option>
                <?php foreach($dataClassesFromPromos as $dataClassesFromPromo){ ?>
                <option value="<?= $dataClassesFromPromo->id_classe ?>" class="<?= $dataClassesFromPromo->id_promo ?>"><?= $dataClassesFromPromo->intituleClasse ?></option>
                <?php } ?>
            </select>
        </div>
        <a href="#">
            Supprimer classe
        </a>
        <div class="user-box">
            <input type="text" name="" required="">
            <label>Nom de la classe à ajouter</label>
        </div>
        <a href="#">
            Ajout classe
        </a>
    </form>
</div>

<div class="login-box">
    <h2>Gestion des niveaux</h2>
    <form>
        <div class="user-box">
            <select name="niveauSelect" id="niveau-select">
                <option value="">Liste niveau</option>
                <?php foreach($dataLevels as $dataLevel){ ?>
                <option value="<?= $dataLevel->id_niveau ?>"><?= $dataLevel->intitule ?></option>
                <?php } ?>
            </select>
        </div>
        <a href="#">
            Supprimer niveau
        </a>
        <div class="user-box">
            <input type="text" name="" required="">
            <label>Niveau à ajouter</label>
        </div>
        <a href="#">
            Ajout niveau
        </a>
    </form>
</div>
<!--TODO Jquery pour les selecteurs (lié ecole/promo/classe)-->
<!--
<script>

    $(document).ready(function() {

        $('#valueEtude').change(function () {
            if ($(this).val() != '') {
                $('#valueEtudePlage').removeAttr('disabled', 'disabled');
                $("#valueEtudePlage").val("");
                $('#valueEtudePlage option').show();
                $("#valueEtudePlage option:not(.e_" + $(this).val() + ")").hide();
                $("#show1").show();
                $('#idEtude').val($(this).val());
            } else {
                $("#valueEtudePlage").attr("disabled", "disabled");
                $("#valueZone").attr("disabled", "disabled");
                $('#btnSend').attr("disabled", "disabled");
                $('#creerZone').attr('disabled', 'disabled');
            }
        });

        $('#valueEtudePlage').change(function () {
            if ($(this).val() != '') {
                $('#valueZone').removeAttr('disabled', 'disabled');
                $('#valueZone').val("");
                $('#valueZone option').show();
                $("#valueZone option:not(.ep_" + $(this).val() + ")").hide();
                $('#show2').show();
                $('#idEtudePlage').val($(this).val());
                $('#creerZone').removeAttr('disabled', 'disabled');
            } else {
                $("#valueZone").attr("disabled", "disabled");
                $('#btnSend').attr("disabled", "disabled");
                $('#creerZone').attr('disabled', 'disabled');
            }
        });

        $('#valueZone').change(function() {
            if ($(this).val() != '') {
                $('#idZone').val($(this).val());
                $('#btnSend').removeAttr("disabled", "disabled");
            } else {
                $('#idZone').val('');
                $('#btnSend').attr("disabled", "disabled");
            }

        });
    });

</script>
-->
