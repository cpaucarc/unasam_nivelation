<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(UTIL_PATH . "Attendance.php");
require_once(UTIL_PATH . "SendMessage.php");

if (isset($_POST['num']) and isset($_POST['attID'])) {
    $num = intval($_POST['num']);
    $attID = intval($_POST['attID']);

    if ($num > 0) {
        $num = 0;
    } else {
        $num = 1;
    }

    $att = new Attendance();
    $rsp = $att->isPresent($num, $attID);

    if ($rsp) {
        echo (new SendMessage("1", true))->getEncodedMessage();
    } else {
        echo (new SendMessage("0", false))->getEncodedMessage();
    }
} else {
    echo (new SendMessage("0", false))->getEncodedMessage();
}