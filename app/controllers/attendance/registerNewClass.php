<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(UTIL_PATH . "Attendance.php");
require_once(UTIL_PATH . "SendMessage.php");

if (isset($_POST['topic']) and isset($_POST['groupID']) and isset($_POST['classDataID'])) {
    $groupID = intval($_POST['groupID']);
    $classDataID = intval($_POST['classDataID']);
    $topic = $_POST['topic'];

    if ($classDataID > 0) {
        //editar
        $attendance = new Attendance();
        $attendance->updateClassData($topic, $classDataID);
        echo (new SendMessage($classDataID, true))->getEncodedMessage();
    } else {
        //guardar
        if ($groupID > 0) {
            $attendance = new Attendance();
            if ($attendance->registerNewClass($topic, $groupID)) {
                $classDataID = $attendance->getClassID($topic, $groupID);
                $attendance->addStudentsToAttendance($groupID, $classDataID);
                echo (new SendMessage($classDataID, true))->getEncodedMessage();
            } else {
                echo (new SendMessage(0, false))->getEncodedMessage();
            }
        } else {
            echo (new SendMessage(0, false))->getEncodedMessage();
        }
    }
} else {
    echo (new SendMessage(0, false))->getEncodedMessage();
}
