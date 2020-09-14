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


    var_dump($_POST);
    $hashed_password = password_hash($_POST["pass"], PASSWORD_DEFAULT);
    $DB_PASS = hpost("http://localhost:4567/api/connect", array("email" => $_POST["email"]));

    var_dump($hashed_password);
    var_dump($DB_PASS);

    var_dump(password_verify($_POST["pass"], $DB_PASS->password));

    if (password_verify($_POST["pass"], $DB_PASS->password)) {

        $_SESSION["token"] = $DB_PASS->token;
        $_SESSION["id_personne"] = $DB_PASS->id_personne;
        $_SESSION["me"] = $DB_PASS;

        header("Location: http://tutorat-workshop/");
    }


//    hpost("http://localhost:4567/api/createForumQuestion", array("titre" => $_POST["title"], "description" => $_POST["description"], "id_personne" => $_POST["id_personne"], "id_matiere" => $_POST["id_matiere"]));
//    die();

}
