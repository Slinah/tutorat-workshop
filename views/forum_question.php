<?php
include_once "includes/composants/nav-bar.php";

$request = explode('/', $_SERVER['REQUEST_URI']);
$id_question = end($request);

$question = hget("http://localhost:4567/api/getQuestion/" . $id_question)[0];
?>

<section id="backgroundTutorat">
    <img src="/ressources/img/backgrounds/darkBackgroundForum.jpg" alt="background Tutorat">
</section>
<section class="headerTitle">
    <h2>Titre du sujet</h2>
</section>

<section class="cardContainer">
    <?php
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
    <section class="card">
        <header>Post principal</header>
        <h2><?php echo $question->titre; ?> | <?php echo $question->status == 0 ? "❓" : "✔" ?> --
            <?php echo $question->intitule; ?></h2>
        <p><?php echo $question->description; ?></p>

        <div class="dateUpRight">
            <?php echo date('j/m/Y', strtotime($question->date)); ?><br>
            <?php echo $question->id_personne == $_SESSION["me"]->id_personne || $_SESSION["me"]->role   ? "<a href='/forum/change/" . $id_question . "'>Editer</a>" : "" ?>

        </div>
        <div class="nameUpLeft">
            Nom - <?php echo $question->prenom; ?><br>
            vote :
            <?php echo $question->votes; ?>
        </div>
        <div class="vote">

        </div>
    </section>
    <div class="commentContainer">
        <button type="button" onclick="clickOpenBtnModal()">Commenter &nbsp;<i class="far fa-comment"></i></button>
    </div>
</section>

<section class="cardContainer">


    <?php
    $t = hget("http://localhost:4567/api/getCommentaire/" . $id_question);


    if (!property_exists((object)$t, "error")) {
        foreach ($t as $c) {
            ?>
            <section class="card">
                <p>
                    <?php
                    echo $c->contenu;
                    ?>
                </p>
                <div class="dateUpRight"><?php
                    echo date('j/m/Y H:i:s', strtotime($c->dateCreation));
                    ?></div>
                <div class="nameUpLeft">
                    <?php
                    echo $c->nom;
                    ?> - <?php
                    echo $c->prenom;
                    ?>
                </div>
            </section>
            <div class="commentContainer">
                <?php if ($c->sub > 0) { ?>
                    <button type="button" onclick="loadMore('<?php echo $c->id_comment; ?>' )">
                        Voir Plus&nbsp;
                        <i class="far fa-comment"></i>
                        (<?php echo $c->sub; ?>)
                    </button> <?php
                } ?>
                <button type="button" onclick="clickOpenBtnModal('<?php echo $c->id_comment; ?>' )">Répondre &nbsp;<i
                            class="far fa-comment"></i>
                </button>
            </div>
            <?php
        }
    } else {
        ?>
        <section class='card'>
            <header>auccun commentaire
            </header>
        </section>
        <?php
    }
    ?>
</section>
<section id="modalId" class="modal">
    <input type="hidden" id="personne_id" value="<?php echo $_SESSION["me"]->id_personne; ?>">
    <div class="container">
        <div class="comment">
            <form action="POST">
                <div contenteditable="true" class="textinput" id="modalTxt"></div>
                <button type="button" onclick="recuperationTxtModal()">Envoyer le commentaire</button>
            </form>
        </div>
        <div class="closeButton" onclick="clickCloseBtnModal()">
            <i class="far fa-times-circle"></i>
        </div>
    </div>
</section>
