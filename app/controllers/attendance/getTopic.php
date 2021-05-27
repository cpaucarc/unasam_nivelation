<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(UTIL_PATH . "Attendance.php");
require_once(UTIL_PATH . "SendMessage.php");

if ($_POST['classID']) {
    $att = new Attendance();
    echo (new SendMessage($att->getClassTopic($_POST['classID']), true))->getEncodedMessage();
} else {
    echo (new SendMessage("", false))->getEncodedMessage();
}
