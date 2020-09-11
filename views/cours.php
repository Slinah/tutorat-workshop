<?php

include_once "includes/composants/nav-bar.php";

$unclosedCourses = hget("http://localhost:4567/api/unclosedCourses");
?>

<section id="backgroundTutorat">
    <img src="../ressources/img/backgrounds/darkBackgroundLesCours.jpg" alt="background Tutorat">
</section>
<section>
    <p>Tu ne trouves pas le cours que tu voulais ?</p>
    <button>Suggérer un cour</button>
</section>
<?php
$timeZone = new DateTimeZone("Europe/Paris");
$dateTime = new DateTime("now", $timeZone);
$semaineActuelle = (int)date("W", $dateTime->getTimestamp());
$courCetteSemaine = 1;
$courSemaineProchaine = 1;
$coursPlusTard = 1;
foreach ($unclosedCourses as $ligne) {
    $semaineCour = (int)date("W", strtotime($ligne->date));
    if ($semaineCour === $semaineActuelle) {
        if ($courCetteSemaine === 1) {
            // ouverture section + title + card
            echo "
        <section class='headerTitle'>
            <h2>Cette semaine</h2>
        </section>
        <section class='cardContainer'>
            <section class='card'>
            <header>" . $ligne->intitule . "</header>
            <p>Salle : " . $ligne->salle . "
            <br>Dispensé par : " . $ligne->prenom . "
            <br>
            <br>" . $ligne->commentaires . "
            </p>
            <button type='button'>S'inscrire</button>
            <div class='classeUpLeft'>" . $ligne->promo . "</div>
            <div class='dateUpRight'>" . date("d m", strtotime($ligne->date)) . "</div>
            ";
            // Ajouté ici une condition pour savoir si le cour est en distanciel
            if (false) {
                echo "<div class='wifiDownRight'><i class='fas fa-wifi'></i></div>";
            }
            echo "</section>";
            $courCetteSemaine = 0;
        } else {
            // ajout de card
            echo "
            <section class='card'>
            <header>" . $ligne->intitule . "</header>
            <p>Salle : " . $ligne->salle . "
            <br>Dispensé par : " . $ligne->prenom . "
            <br>
            <br>" . $ligne->commentaires . "
            </p>
            <button type='button'>S'inscrire</button>
            <div class='classeUpLeft'>" . $ligne->promo . "</div>
            <div class='dateUpRight'>" . date("d m", strtotime($ligne->date)) . "</div>
            ";
            // Ajouté ici une condition pour savoir si le cour est en distanciel
            if (false) {
                echo "<div class='wifiDownRight'><i class='fas fa-wifi'></i></div>";
            }
            echo "</section>";
        }
    }
    // Fermeture section
    if ($semaineCour !== $semaineActuelle && $courCetteSemaine === 0) {
        $courCetteSemaine=2;
        echo "</section>";
    }
    if ($semaineCour === $semaineActuelle+1) {
        if ($courSemaineProchaine === 1) {
            // ajout title + section + card , seconde partie
            echo "
        <section class='headerTitle'>
            <h2>Semaine prochaine</h2>
        </section>
        <section class='cardContainer'>
            <section class='card'>
            <header>" . $ligne->intitule . "</header>
            <p>Salle : " . $ligne->salle . "
            <br>Dispensé par : " . $ligne->prenom . "
            <br>
            <br>" . $ligne->commentaires . "
            </p>
            <button type='button'>S'inscrire</button>
            <div class='classeUpLeft'>" . $ligne->promo . "</div>
            <div class='dateUpRight'>" . date("d m", strtotime($ligne->date)) . "</div>
            ";
            // Ajouté ici une condition pour savoir si le cour est en distanciel
            if (false) {
                echo "<div class='wifiDownRight'><i class='fas fa-wifi'></i></div>";
            }
            echo "</section>";
            $courSemaineProchaine = 0;
        } else {
            // ajout de card
            echo "
            <section class='card'>
            <header>" . $ligne->intitule . "</header>
            <p>Salle : " . $ligne->salle . "
            <br>Dispensé par : " . $ligne->prenom . "
            <br>
            <br>" . $ligne->commentaires . "
            </p>
            <button type='button'>S'inscrire</button>
            <div class='classeUpLeft'>" . $ligne->promo . "</div>
            <div class='dateUpRight'>" . date("d m", strtotime($ligne->date)) . "</div>
            ";
            // Ajouté ici une condition pour savoir si le cour est en distanciel
            if (false) {
                echo "<div class='wifiDownRight'><i class='fas fa-wifi'></i></div>";
            }
            echo "</section>";
        }
    }
    // fermeture seconde section principale
    if ($semaineCour !== $semaineActuelle+1 && $courSemaineProchaine === 0) {
        $courSemaineProchaine=2;
        echo "</section>";

    }
    if ($semaineCour > $semaineActuelle+1) {
        if ($coursPlusTard === 1) {
            // ajout title + section + card , troisieme partie
            echo "
        <section class='headerTitle'>
            <h2>Plus tard</h2>
        </section>
        <section class='cardContainer'>
            <section class='card'>
            <header>" . $ligne->intitule . "</header>
            <p>Salle : " . $ligne->salle . "
            <br>Dispensé par : " . $ligne->prenom . "
            <br>
            <br>" . $ligne->commentaires . "
            </p>
            <button type='button'>S'inscrire</button>
            <div class='classeUpLeft'>" . $ligne->promo . "</div>
            <div class='dateUpRight'>" . date("d m", strtotime($ligne->date)) . "</div>
            ";
            // Ajouté ici une condition pour savoir si le cour est en distanciel
            if (false) {
                echo "<div class='wifiDownRight'><i class='fas fa-wifi'></i></div>";
            }
            echo "</section>";
            $coursPlusTard = 0;
        } else {
            // ajout card
            echo "
            <section class='card'>
            <header>" . $ligne->intitule . "</header>
            <p>Salle : " . $ligne->salle . "
            <br>Dispensé par : " . $ligne->prenom . "
            <br>
            <br>" . $ligne->commentaires . "
            </p>
            <button type='button'>S'inscrire</button>
            <div class='classeUpLeft'>" . $ligne->promo . "</div>
            <div class='dateUpRight'>" . date("d m", strtotime($ligne->date)) . "</div>
            ";
            // Ajouté ici une condition pour savoir si le cour est en distanciel
            if (false) {
                echo "<div class='wifiDownRight'><i class='fas fa-wifi'></i></div>";
            }
            echo "</section>";
        }
    }
}
// fermeture dernière section
if ($coursPlusTard === 0 || $courSemaineProchaine === 0 || $courCetteSemaine===0) {
    echo "</section>";
}
?>
