<?php

include_once "includes/composants/nav-bar.php";


// POST

//$url = 'http://server.com/path';
//$data = array('key1' => 'value1', 'key2' => 'value2');
//
//// use key 'http' even if you send the request to https://...
//$options = array(
//    'http' => array(
//        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
//        'method' => 'POST',
//        'content' => http_build_query($data)
//    )
//);
//$context = stream_context_create($options);
//$result = file_get_contents($url, false, $context);
//if ($result === FALSE) { /* Handle error */
//}


// GET
$posts = json_decode(file_get_contents("http://localhost:4567/api/getForumQuestions"));


//var_dump($posts);

?>


<h2>Forum</h2>

<h3>Discute avec tous le monde ! Et apprends de nouvelles choses !</h3>

<a href="#">Créer un post</a>
<div class="list-posts">
    <h2>Sujet ouverts en ce moment </h2>

    <?php
    foreach ($posts as $p) {
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
