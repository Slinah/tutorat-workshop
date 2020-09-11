<?php
require_once "../includes/functions.php";

$intituleSubject = filter_input(INPUT_POST, 'addSubject');

hpost('http://localhost:4567/api/addSubject', array('intitule' => $intituleSubject));

header('location: /admin');
