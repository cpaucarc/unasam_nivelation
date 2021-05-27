<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(UTIL_PATH . "Classroom.php");

if (isset($_POST['scheduleID'])) {
    $schID = intval($_POST['scheduleID']);

    if ($schID > 0) {
        $classroom = new Classroom();
        $classroom->deleteSchedule($_POST['scheduleID']);
    }
}
echo 0;