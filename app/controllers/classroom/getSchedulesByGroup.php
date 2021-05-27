<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(UTIL_PATH . "Classroom.php");

if (isset($_POST['groupID'])) {
    $groupID = intval($_POST['groupID']);
    if ($groupID > 0) {
        $classroom = new Classroom();
        echo $classroom->getSchedulesByGroup($groupID);
    }
}
