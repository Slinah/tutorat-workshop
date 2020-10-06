<?php
include_once "includes/composants/nav-bar.php";
$unclosedCourses = hget("http://localhost:4567/api/unclosedCourses");
if(property_exists((object)$unclosedCourses, "error")){
    $unclosedCourses=null;
}
$tabGetCoursById=[];
$formatDate="d.m // H\hi";
$timeZone = new DateTimeZone("Europe/Paris");
$dateTime = new DateTime("now", $timeZone);
$semaineActuelle = (int)date("W", $dateTime->getTimestamp());
$courCetteSemaine = 1;
$courSemaineProchaine = 1;
$coursPlusTard = 1;
$idPersonneConnecter = (string)($_SESSION["me"]->id_personne);
$getCoursById = hget("http://localhost:4567/api/peopleCourseById?idPeople=" . $idPersonneConnecter);
if(property_exists((object)$getCoursById, "error")){
    $getCoursById=null;
}
if ($getCoursById !== null) {
    foreach ($getCoursById as $ligne) {
        $tabGetCoursById[] = $ligne->id_cours;
    }
} else {
    $tabGetCoursById = null;
}
// fonction d'affichage d'une card complète
function codeRefacto($ligne, $idPersonneConnecter, $tabGetCoursById,$timeZone,$formatDate)
{
    echo "
            <section class='card'>
            <header>".$ligne->matiere." // " . $ligne->intitule . "</header>
            <p>Salle : ";
    if ($ligne->salle !== null) {
        echo $ligne->salle;
    } else {
        echo "Non attribuer";
    }
    echo "
            <br>Dispensé par : " . $ligne->prenom . " " . ($ligne->nom)[0] . "
            <br>
            <br>" . $ligne->commentaires . "
            </p>
            <form method='post' action='/actions/actionsRegistrationCourse.php'>
            <input type='hidden' name='id_cours' value='" . $ligne->idCours . "'> 
            <input type='hidden' name='id_personne' value='" . $idPersonneConnecter . "'>
        ";
    // Condition visuelle pour savoir si on est inscrit à un cours ou non.
    if ($tabGetCoursById !== null) {
        if (in_array($ligne->idCours, $tabGetCoursById, false)) {
            echo "<button disabled>Inscrit(e)</button>";
        } else {
            echo "<button type='submit'>S'inscrire</button>";
        }
    } else {
        echo "<button type='submit'>S'inscrire</button>";
    }
    echo "
            </form>
            <div class='classeUpLeft'>" . $ligne->promo . "</div>
            ";
    $dateTimeFormatage = new DateTime($ligne->date, $timeZone);
    echo "
            <div class='dateUpRight'>" . $dateTimeFormatage->format($formatDate) . "</div>
    ";
    // Ajouté ici une condition pour savoir si le cour est en distanciel
//    if (false) {
//        echo "
//            <div class='wifiDownRight'><i class='fas fa-wifi'></i></div>
//            ";
//    }
    echo "</section>";
}
if (isset($_SESSION['retourUser'])) {
    retourUtilisateur($_SESSION['retourUser']);
}
?>
    <section id="backgroundTutorat">
        <img src="/ressources/img/backgrounds/darkBackgroundLesCoursHalloween.png" alt="background Tutorat">
    </section>
    <section>
        <p>Tu ne trouves pas le cours que tu voulais ?</p>
        <button onclick="document.location.href='/donner-cours'">Suggérer un cour</button>
    </section>
<?php
if ($unclosedCourses !== null) {
    foreach ($unclosedCourses as $ligne) {
        $semaineCour = (int)date("W", strtotime($ligne->date));
        if ($semaineCour === $semaineActuelle) {
            if ($courCetteSemaine === 1) {
                echo "
                <section id='inSemaine' class='headerTitle'>
                    <h2>Cette semaine</h2>
                </section>
                <section class='cardContainer'>";
                codeRefacto($ligne, $idPersonneConnecter, $tabGetCoursById, $timeZone,$formatDate);
                $courCetteSemaine = 0;
            } else {
                codeRefacto($ligne, $idPersonneConnecter, $tabGetCoursById, $timeZone,$formatDate);
            }
        }
        // Fermeture section du container seulement quand on a fini tout l'affichage de la première semaine
        if ($semaineCour !== $semaineActuelle && $courCetteSemaine === 0) {
            $courCetteSemaine = 2;
            echo "</section>";
        }
        if ($semaineCour === $semaineActuelle + 1) {
            if ($courSemaineProchaine === 1) {
                echo "
                <section class='headerTitle'>
                <h2>Semaine prochaine</h2>
                </section>
                <section class='cardContainer'>";
                codeRefacto($ligne, $idPersonneConnecter, $tabGetCoursById, $timeZone,$formatDate);
                $courSemaineProchaine = 0;
            } else {
                codeRefacto($ligne, $idPersonneConnecter, $tabGetCoursById, $timeZone,$formatDate);
            }
        }
        // fermeture seconde section principale
        if ($semaineCour !== $semaineActuelle + 1 && $courSemaineProchaine === 0) {
            $courSemaineProchaine = 2;
            echo "</section>";
        }
        if ($semaineCour > $semaineActuelle + 1) {
            if ($coursPlusTard === 1) {
                echo "
                <section class='headerTitle'>
                    <h2>Plus tard</h2>
                </section>
                <section class='cardContainer'>";
                codeRefacto($ligne, $idPersonneConnecter, $tabGetCoursById, $timeZone,$formatDate);
                $coursPlusTard = 0;
            } else {
                codeRefacto($ligne, $idPersonneConnecter, $tabGetCoursById, $timeZone,$formatDate);
            }
        }
    }
}
// fermeture dernière section , si une des variables est égale a 0, alors c'est que son container n'as pas encore été fermé
// on ferme une seule section, car il n'est possible d'avoir qu'une seule de ces 3 variables égales à 0 en même temps
if ($coursPlusTard === 0 || $courSemaineProchaine === 0 || $courCetteSemaine === 0) {
    echo "</section>";
}
