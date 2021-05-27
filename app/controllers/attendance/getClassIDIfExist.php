<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(UTIL_PATH . "Attendance.php");
require_once(UTIL_PATH . "SendMessage.php");

if ($_POST['groupID']) {
    $att = new Attendance();
    $id = $att->getClassIDIfExist(intval($_POST['groupID']));
    echo (new SendMessage($id, true))->getEncodedMessage();
} else {
    echo (new SendMessage(0, false))->getEncodedMessage();
}
