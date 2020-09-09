<?php

$request = explode('/', $_SERVER['REQUEST_URI']);
$id_question = end($request);


$question = http_get("http://localhost:4567/api/getQuestion/" . $id_question)[0];
var_dump($question);


if (is_null($question)) {
    ?>
    <div class="error">
        <h2>Cette question n'existe pas ou plus ! </h2>
        <a href="/forum">Retour vers la liste</a>
    </div>
    <?php
    die();
}
?>

    <div class="posts">
        <div class="vote">
            <a>
                ➕
            </a>
            <p>
                <?php
                echo $question->votes;
                ?>
            </p>
        </div>
        <div class="right-post">
            <p>
                <?php
                echo $question->prenom;
                ?>

                <?php
                echo date('j/m', strtotime($question->date));
                ?>
            </p>

            <h3>
                <a href="/forum/<?php
                echo $question->id_question;
                ?>">
                    <?php
                    echo $question->titre;
                    ?>
                </a>
                <?php
                echo $question->status == 0 ? "❓" : "✔"
                ?>
            </h3>
            <p>
                <?php
                echo $question->description;
                ?>
            </p>
            <p>
                <?php
                echo $question->intitule;
                ?>
            </p>

            <p>Nombre de com :
                <?php
                echo $question->comments;
                ?>
            </p>
        </div>
    </div>

<?php

$t = http_get("http://localhost:4567/api/getCommentaire/" . $id_question);
if (!is_null($t)) {

    foreach ($t as $c) {
//    var_dump($c);
        ?>

        <div class="comment">
            <p>
                <?php
                echo $c->nom;
                ?> - <?php
                echo $c->prenom;
                ?></p>
            <h3><?php
                echo $c->contenu;
                ?></h3>
            <p><?php
                echo date('j/m', strtotime($c->dateCreation));
                ?></p>
            <a href="">reply</a>
        </div>


        <?php
    }
} else {
    ?>

    <p>Auccun commentaire </p>


    <?php

}

?>
