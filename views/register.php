<?php
//include_once "includes/composants/nav-bar.php";
?>

<section class="headerTitle">
    <h2>Connexion</h2>
</section>


<div class="login-box">
    <h2>Créer un compte</h2>
    <form>

        <div class="user-box">
            <select name="school" id="school-select">
                <option value="">Choisir l'école</option>
                <option value="ecole1">Ecole 1</option>
                <option value="ecole2">Ecole 2</option>
            </select>
        </div>
        <div class="user-box">
            <select name="promo" id="promo-select" disabled>
                <option value="">Choisir promo</option>
                <option value="promo1">Promo 1</option>
                <option value="promo2">Promo 2</option>
            </select>
        </div>
        <div class="user-box">
            <input type="text" name="" required="">
            <label>Prénom</label>
        </div>
        <div class="user-box">
            <input type="text" name="" required="">
            <label>Nom</label>
        </div>
        <div class="user-box">
            <input type="text" name="" required="">
            <label>Mail</label>
        </div>
        <div class="user-box">
            <input type="password" name="" required="">
            <label>Password</label>
        </div>
        <a href="#">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            S'enregistrer
        </a>
        <a href="#">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            Se connecter
        </a>
    </form>
</div>
