<?php

function footer_options(array $js)
{

    foreach ($js as $j) {

        echo "<script src='/ressources/js/" . $j . ".js'></script>";
    }
    echo "</head><body>";
}


