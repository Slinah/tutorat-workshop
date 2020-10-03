<?php
function hpost(string $url, array $param = [])
{
    $options = array(
        'http' => array(
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($param)
        )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    return json_decode($result);
}

function hget(string $url)
{
    return json_decode(file_get_contents($url));
}


function sanitize($string)
{
    return filter_var($string, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}


function retourUtilisateur($retourUtilisateur)
{
    if (property_exists((object)$retourUtilisateur, "error")) {
        ?>
        <div id="retourUtilisateurContainer">
            <div id="retourUtilisateur" onload="this.style.zIndex='-1'">Erreur ! <?= $retourUtilisateur->error ?></div>
        </div>
        <?php
        unset($_SESSION['retourUser']);
    } elseif (property_exists((object)$retourUtilisateur, "success")) {
        ?>
        <div id="retourUtilisateurContainer">
            <div id="retourUtilisateur">Success ! <?= $retourUtilisateur->success ?> </div>
        </div>
        <?php
        unset($_SESSION['retourUser']);
    } else {
        ?>
        <div id="retourUtilisateurContainer">
            <div id="retourUtilisateur">Tout c'est bien passé !</div>
        </div>
        <?php
        unset($_SESSION['retourUser']);
    }
}



















