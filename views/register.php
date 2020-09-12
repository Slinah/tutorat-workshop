<?php
//include_once "includes/composants/nav-bar.php";
?>


    <div class="login-box">
        <h2>Créer un compte</h2>
        <form>

            <div class="user-box">
                <select name="school" id="school-select" onchange="console.log(this.value)">
                    <option value="">Choisir l'école</option>
                    <option value="ecole1">Ecole 1</option>
                    <option value="ecole2">Ecole 2</option>
                </select>
            </div>
            <div class="user-box">
                <select name="promo" id="promo-select">
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
            <a href="/connexion">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                S'enregistrer
            </a>
            <a href="/connexion">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Se connecter
            </a>
        </form>
    </div>


<?php


if (!empty($_POST)) {


    var_dump($_POST);
    $hashed_password = password_hash($_POST["pass"], PASSWORD_DEFAULT);
    $DB_PASS = hpost("http://localhost:4567/api/createAccount",

        array(
            "school" => $_POST["email"],
            "promo" => $_POST["email"],
            "firstname" => $_POST["email"],
            "lastname" => $_POST["email"],
            "email" => $_POST["email"],
            "password" => $_POST["email"],
        ));


    var_dump($hashed_password);
    var_dump($DB_PASS);

    var_dump(password_verify($_POST["pass"], $DB_PASS->password));

    if (password_verify($_POST["pass"], $DB_PASS->password)) {

        $_SESSION["token"] = $DB_PASS->token;
        $_SESSION["id_personne"] = $DB_PASS->id_personne;
        $_SESSION["me"] = $DB_PASS;

    }


//    hpost("http://localhost:4567/api/createForumQuestion", array("titre" => $_POST["title"], "description" => $_POST["description"], "id_personne" => $_POST["id_personne"], "id_matiere" => $_POST["id_matiere"]));
//    header("Location: http://tutorat-workshop/forum");
//    die();

}






