<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(UTIL_PATH . "Attendance.php");
require_once(UTIL_PATH . "SendMessage.php");

if (isset($_POST['classDataID'])) {
    $classID = intval($_POST['classDataID']);

    if ($classID > 0) {
        $attendance = new Attendance();
        echo $attendance->getStudentsOfClass($classID);
    } else {
        echo (new SendMessage("Faltan Datos", false))->getEncodedMessage();
    }
} else {
    echo (new SendMessage(0, false))->getEncodedMessage();
}