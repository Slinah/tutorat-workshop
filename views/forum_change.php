<?php
include_once "includes/composants/nav-bar.php";

$request = explode('/', $_SERVER['REQUEST_URI']);
$id_question = end($request);

$question = hget("http://localhost:4567/api/getQuestion/" . $id_question)[0];


?>


<div class="login-box">
    <h2>Créer un nouveau sujet !</h2>
    <form class="in_box" method="post">
        <div class="user-box">
            <input type="text" class="title" name="title" required value="<?php echo $question->titre?>" >
            <label>Titre :</label>
        </div>
        <div class="user-box">
            <select name="id_matiere" id="matiere-select" required>
                <option value="">Matière</option>
                <?php
                foreach (hget("http://localhost:4567/api/getMatiere") as $m) {
                    echo "<option value=" . $m->id_matiere . ">" . $m->intitule . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="user-box">
            <textarea name="description" required placeholder="description :"></textarea>
        </div>
        <input type="hidden" name="id_personne" value="<?php
        echo $_SESSION["me"]->id_personne;
        ?>">
        <button type="submit">Envoyer la demande</button>
    </form>
</div>
<?php
var_dump($question);
if (!empty($_POST)) {
    hpost("http://localhost:4567/api/createForumQuestion", array("titre" => sanitize($_POST["title"]), "description" => sanitize($_POST["description"]), "id_personne" => sanitize($_POST["id_personne"]), "id_matiere" => sanitize($_POST["id_matiere"])));
    header("Location: http://tutorat-workshop/forum");
    die();
}
