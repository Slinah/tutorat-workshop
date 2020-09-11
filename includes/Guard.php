<?php

$_SESSION["token"] = "917bb914-f0e3-11ea-adc1-0242ac12000"; // 2


function is_connected()
{
// var_dump(hpost("http://localhost:4567/api/isConnected", array("token" => $_SESSION["token"])));
    if (hpost("http://localhost:4567/api/isConnected", array("token" => $_SESSION["token"]))->check) {
      header("Location: /register");
    }
}


function is_admin()
{
// var_dump(hpost("http://localhost:4567/api/isAdmin", array("token" => $_SESSION["token"])));
    if (hpost("http://localhost:4567/api/isAdmin", array("token" => $_SESSION["token"]))->admin) {
        header("Location: /connect");
    }
}

