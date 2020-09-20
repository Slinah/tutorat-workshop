<?php
//include_once "includes/composants/nav-bar.php";


?>


    <div class="login-box">
        <h2>Connexion</h2>
        <form method="post" id="connect" action="">
            <div class="user-box">
                <input type="email" name="email" required>
                <label>Email</label>
            </div>
            <div class="user-box">
                <input type="password" name="pass" required>
                <label>Mot de passe</label>
            </div>
            <a onclick="document.getElementById('connect').submit()" type="submit">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Se connecter
            </a>
            <a href="/register">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Créer un compte
            </a>
        </form>
    </div>


<?php


if (!empty($_POST)) {


//    var_dump($_POST);

    $DB_PASS = hpost("http://localhost:4567/api/connect", array("email" => $_POST["email"]));

//    var_dump(password_verify($_POST["pass"], $DB_PASS->password));

    if (password_verify($_POST["pass"], $DB_PASS->password)) {
        $_SESSION["me"] = $DB_PASS;
        header("Location: http://workshop/");
        die();
    }
}
