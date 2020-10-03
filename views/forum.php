<?php
include_once "includes/composants/nav-bar.php";
if (!empty($_POST)) {
    hpost("http://localhost:4567/api/upvoteQuestion", array("id_personne" => $_SESSION["me"]->id_personne, "id_question" => $_POST["question_id"]));
}
?>
<section id="backgroundTutorat">
    <img src="/ressources/img/backgrounds/darkBackgroundForum.jpg" alt="background Tutorat">
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

    $forumData = hget("http://localhost:4567/api/getForumQuestions");


    if (!property_exists((object)$forumData, "error")) {


        foreach ($forumData as $p) {
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
                    echo substr($p->description, 0, 45) . ".....";
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
                <form method="post">
                    <input type="hidden" name="question_id" value="<?php echo $p->id_question; ?>">
                    <button type="submit" class="buttonDownLeft"><i class="far fa-thumbs-up"></i> <?php
                        echo $p->votes;
                        ?>
                    </button>
                    <?php
                    echo $p->comments;
                    ?> <i class="far fa-comment"></i>
                </form>
            </section>
            <?php
        }
    } else {
        ?>


        <section class='card'>
            <header>Il n'y a pas de sujet pour le moment.</header>
        </section>


        <?php


    }
    ?>
</section>
<section class="headerTitle">
    <h2>Tu veux créer ton sujet ? </h2>
    <button>Créer un sujet</button>
</section>
