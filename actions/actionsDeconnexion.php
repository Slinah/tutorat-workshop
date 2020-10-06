<?php
require_once "../includes/functions.php";
require_once  "../includes/Guard.php";
session_start();
Destroy();
header('location: /');
