<?php

include_once "includes/composants/nav-bar.php";


?>

<div class="section_haute">
    <h2>Forum</h2>

    <h3>Discute avec tous le monde ! Et apprends de nouvelles choses !</h3>


    <a href="/forum/create">Créer un post</a>

</div>

<div class="list-posts">
    <h2>Sujet ouverts en ce moment </h2>

    <?php
    foreach (http_get("http://localhost:4567/api/getForumQuestions") as $p) {
        ?>
        <div class="posts">
            <div class="vote">
                <a>
                    ➕
                </a>
                <p>
                    <?php
                    echo $p->votes;
                    ?>
                </p>
            </div>
            <div class="right-post">
                <p>
                    <?php
                    echo $p->prenom;
                    ?>
                </p>
                <h3>
                    <a href="hello">
                        <?php
                        echo $p->titre;
                        ?>
                    </a>
                    <?php
                    echo $p->status == 0 ? "❓" : "✔✔"
                    ?>
                </h3>
                <p>
                    <?php
                    echo $p->description;
                    ?>
                </p>
                <p>
                    <?php
                    echo $p->intitule;
                    ?>
                </p>

                <p>Nombre de com :
                    <?php
                    echo $p->comments;
                    ?>
                </p>
            </div>
        </div>

        <?php
    }
    ?>

</div>
