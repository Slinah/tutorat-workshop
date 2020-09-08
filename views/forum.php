<?php

include_once "includes/composants/nav-bar.php";


?>


<section id="backgroundTutorat">
    <img src="/ressources/img/imageBackground.jpg" alt="background Tutorat">
</section>
<section>
    <p>Discute avec tous le monde ! et apprends de nouvelles choses !</p>
    <button onclick="window.location.href = '/forum/create';">Créer un sujet</button onc>
</section>
<section class="headerTitle">
    <h2>Sujets</h2>
</section>
<section class="cardContainer">


    <?php
    foreach (http_get("http://localhost:4567/api/getForumQuestions") as $p) {
        ?>


        <section class="card">
            <!--        todo liens vers la page du sujet -->
            <header><a href="/forum/<?php echo $p->id_question; ?>">
                    <?php echo $p->titre; ?>
                    &nbsp;-&nbsp;<?php
                    echo $p->status == 0 ? "❓" : "✔✔"
                    ?>
                </a></header>
            <p>
                <?php
                echo $p->intitule;
                ?>
            </p>
            <p>
                <?php
                echo $p->description;
                ?>
            </p>
            <p>
                Nombre de commentaire :
                <?php
                echo $p->comments;
                ?>
            </p>
            <div class="classeDownRight">Classe</div>
            <div class="dateUpRight">
                <?php
                echo date('j/m', strtotime($p->date));
                ?>
            </div>
            <div class="nameUpLeft">
                <?php
                echo $p->prenom;
                ?>

            </div>
            <button type="button" class="buttonDownLeft"><i class="far fa-thumbs-up"></i> <?php
                echo $p->votes;
                ?></button>
        </section>
        <?php
    }
    ?>


</section>
<section class="headerTitle">
    <h2>Tu veux créer ton sujet ? </h2>
    <button>Créer un sujet</button>
</section>
