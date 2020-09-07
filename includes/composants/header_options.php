<?php

function header_options(array $styles)
{

    foreach ($styles as $s) {

        echo "<link rel='stylesheet' href='ressources/css/" . $s . ".css'>";
    }
    echo "</head><body><div class='page'>";
}




