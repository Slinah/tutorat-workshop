<?php

include_once "includes/composants/nav-bar.php";


?>


<h2>Forum</h2>

<h3>Discute avec tous le monde ! Et apprends de nouvelles choses !</h3>

<a href="#">Créer un post</a>
<div class="list-posts">
    <h2>Sujet ouverts en ce moment </h2>

    <?php
    foreach (http_get("http://localhost:4567/api/getForumQuestions") as $p) {
        ?>
        <div class="posts">
            <h3>
                <?php
                echo $p->titre;
                ?>
            </h3>
            <p>
                <?php
                echo $p->description;
                ?>
            </p>
            <p>
                <?php
                echo $p->prenom;
                ?>
            </p>
            <p>
                <?php
                echo $p->intitule;
                ?>
            </p>
            <p>
                status de la question :
                <?php
                echo $p->status;
                ?>
            </p>
            <p>Nombre de vote :
                <?php
                echo $p->votes;
                ?>

            </p>
            <p>Nombre de com :
                <?php
                echo $p->comments;
                ?>
            </p>
        </div>
        <?php
    }
    ?>

</div>
