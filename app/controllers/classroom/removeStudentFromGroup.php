<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(UTIL_PATH . "Classroom.php");

if (isset($_POST['stgrID'])) {
    $classroom = new Classroom();
    $classroom->removeStudentFromGroup(intval($_POST['stgrID']));
    echo 1;
} else {
    echo 0;
}
