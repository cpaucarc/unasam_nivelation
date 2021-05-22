<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(UTIL_PATH . "Classroom.php");

$classroom = new Classroom();
echo $classroom->getAllGroups();
