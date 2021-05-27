<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(UTIL_PATH . "Classroom.php");

if (isset($_POST['stdtID']) and isset($_POST['groupID'])) {
    $classroom = new Classroom();
    $classroom->addStudentToGroup(intval($_POST['stdtID']), intval($_POST['groupID']));
    echo 1;
} else {
    echo 0;
}