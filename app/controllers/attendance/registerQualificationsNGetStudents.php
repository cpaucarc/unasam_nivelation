<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(UTIL_PATH . "Attendance.php");
require_once(UTIL_PATH . "SendMessage.php");

if (isset($_POST['groupID'])) {
    $groupID = intval($_POST['groupID']);

    if ($groupID > 0) {
        $att = new Attendance();

        if (!$att->verifyExistanceOfQualificationForGroup($groupID)) {
            //aun no existe
            $att->addStudentsForQualification($groupID);
        }
        //ya existe
        echo $att->getStudentsForQualification($groupID);
    } else {
        echo (new SendMessage("No hay datos", false))->getEncodedMessage();
    }
} else {
    echo (new SendMessage("No hay datos", false))->getEncodedMessage();
}
