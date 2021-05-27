<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(UTIL_PATH . "Attendance.php");
require_once(UTIL_PATH . "SendMessage.php");

if (isset($_POST['groupID'])) {
    $att = new Attendance();
    echo $att->getSchedulesOfClass($_POST['groupID']);
} else {
    echo (new SendMessage("No hay datos", false))->getEncodedMessage();
}
