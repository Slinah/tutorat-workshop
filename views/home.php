<?php
include_once "includes/composants/nav-bar.php";

if (isset($_SESSION['retourUser'])) {
    retourUtilisateur($_SESSION['retourUser']);
}

?>

<section id="backgroundTutorat">
    <img src="/ressources/img/backgrounds/darkBackgroundTutoratEtEntraideHalloween.jpg" alt="background Tutorat">
</section>
<section class="headerTitle">
    <h2>Le tutorat c'est quoi ?</h2>
</section>
<section>
    <p>"Enseigner, c'est apprendre deux fois."

        <br>Joseph Joubert.
        <br>
        <br>Le tutorat est un projet étudiant qui permet de mettre en relation les apprenants de votre campus afin de
        mettre en place
        <br>un système d'entraide. Tous les apprenants peuvent tutorer peu importe leur niveau, le principe étant de se
        motiver mutuellement
        et de s'entraider.
    </p>
    <button type="button"><a href="/cours">Les cours</a></button>
</section>
<section class="headerTitle">
    <h2>Participer</h2>
</section>
<section class="cardContainer">
    <section class="card">
        <header>Les cours</header>
        <p> Des difficultés dans une matière ? Envie de compléter tes connaissances ou de tout simplement venir en aide
            à un tuteur&nbsp;?
            <br> pas de problèmes ! inscris-toi dès maintenant aux cours qui t'intéresse.
        </p>
        <button type="button" onclick="document.location.href='/cours'">Voir les cours</button>
    </section>
    <section class="card">
        <header>Donner un cours</header>
        <p>
            Que tu sois à l'aise dans une matière, que tu veuilles t'améliorer à l'oral ou vous motiver à plusieurs,
            <br> n'hésites pas à proposer un cours afin de valider tes compétences.
        </p>
        <button type="button" onclick="document.location.href='/donner-cours'">Tutorer</button>
    </section>
    <section class="card">
        <header>Suggérer un cours</header>
        <p> Besoin d'un cours qui n'a pas encore été proposé ? Suggère-le dès maintenant et notre équipe
            <br> se charge de te trouver un tuteur calé sur le sujet.
        </p>
        <button type="button" onclick="document.location.href='/suggestion-cours'">Suggérer</button>
    </section>
</section>
<section class="headerTitle">
    <h2>Pourquoi donner un cours ?</h2>
</section>
<section>
    <p>Le tutorat te pousse à t'améliorer que tu sois participant ou tuteur.
        <br>Devenir tuteur permet une construction du savoir par l'apprentissage.
        <br>Cela peut t'aider à prendre confiance en toi ou tout simplement partager et aider.
        <br>
    </p>
    <button type="button" onclick="document.location.href='/donner-cours'">Tutorer</button>
</section>
