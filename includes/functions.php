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

function retourUtilisateur($retourApi)
{
    if ($retourApi[0]->msg != null) {
        ?>
        <div id="retourUtilisateur" onload="this.style.zIndex='-1'"> La demande à bien été traité !</div>
        <?php
    } else {
        ?>
        <div id="retourUtilisateur"> Une erreur est survenue !</div>
    <?php }
} ?>
