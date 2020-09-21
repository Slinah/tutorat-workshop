<header class="navHeader">
    <div id="navTop">
        <a href="#"><img src="/ressources/img/favicon.png" alt="logo" class="logo"></a>
        <a class="disabled" onclick="clickNavBtn();" id="navBtnPhone">
            <div id="navBtn"></div>
        </a>
    </div>
    <div id="navHidden">
        <nav>
            <ul>
                <li><a href="/cours" onclick="clickNavBtn();">Les cours</a></li>
                <li><a href="/donner-cours" onclick="clickNavBtn();">Donner un cours</a></li>
                <li><a href="/suggestion-cours" onclick="clickNavBtn();">Suggérer un cours</a></li>
                <li><a href="/forum" onclick="clickNavBtn();">Forum</a></li>

                <?php

                if (isset($_SESSION["me"]->id_personne)) {

                    echo "<li><a href='/profile'>Mon profil</a></li>";

                } else {
                    echo "<li><a href='/connexion'>se connecter</a></li>";


                }


                ?>
                <li><a href="/profile" onclick="clickNavBtn();">Mon profil</a></li>
            </ul>
        </nav>
    </div>
    <div id="navDesktop">
        <ul>
            <div>
                <li><a href="/"><img src="/ressources/img/favicon.png" alt="logo" class="logo"></a></li>
                <li class="bold"><a href="/">Scratch Overflow</a></li>
            </div>

            <!--            todo si connecter afficher 'Mon profil', si ce n'est pas le cas, afficher 'Connexion / Inscription' -->


            <?php

            if (isset($_SESSION["me"]->id_personne)) {

                echo "<li><a href='/cours'>Les cours</a></li>
            <li><a href='/donner-cours'>Donner un cours</a></li>
            <li><a href='/suggestion-cours'>Suggérer un cours</a></li>
            <li><a href='/forum'>Forum</a></li>
            <li><a href='/profile'>Mon profil</a></li>";

            } else {
                echo " <li><a href='/forum'>Forum</a></li>
 <li><a href='/connexion'>se connecter</a></li>";


            }

            ?>

        </ul>
    </div>
</header>

