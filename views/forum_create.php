<?php

include_once "includes/composants/nav-bar.php";
?>


    <div class="section">
        <h2>Posé une question a propos de ce que vous voulez !</h2>
        <form class="in_box" method="post">
            <label>Titre :
                <input type="text" class="title" name="title">
            </label>
            <label>matiere :
                <select name="id_matiere" id="matiere-select">
                    <?php
                    foreach (hget("http://localhost:4567/api/getMatiere") as $m) {
                        echo "<option value=" . $m->id_matiere . ">" . $m->intitule . "</option>";
                    }
                    ?>
                </select>
            </label>
            <label class="description">description :
                <textarea name="description"></textarea>
            </label>
            <input type="hidden" name="id_personne" value="<?php
            echo $_SESSION["me"]->id_personne;
            ?>">
            <div class="btn">
                <input type="submit" value="Créer" class="submit">
            </div>
        </form>
    </div>


<?php

if (!empty($_POST)) {


    hpost("http://localhost:4567/api/createForumQuestion", array("titre" => sanitize($_POST["title"]), "description" => sanitize($_POST["description"]), "id_personne" => sanitize($_POST["id_personne"]), "id_matiere" => sanitize($_POST["id_matiere"])));
    header("Location: http://tutorat-workshop/forum");
    die();

}
