<?php
require_once "../includes/functions.php";

$intituleSubject = filter_input(INPUT_POST, 'addSubject', FILTER_SANITIZE_SPECIAL_CHARS);

hpost('http://localhost:4567/api/addSubject', array('intitule' => $intituleSubject));

header('location: /admin');
