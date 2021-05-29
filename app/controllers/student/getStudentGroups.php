<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(MODEL_PATH . "StudentModel.php");
require_once(UTIL_PATH . "SendMessage.php");

try {
    $stdtID = $_POST['stdtID'];

    if (isset($stdtID)) {
        $student = new StudentModel();

        echo($student->getStudentGroups($stdtID));
    } else {
        echo (new SendMessage("Error, no se pudo encontrar la informacion", false))->getEncodedMessage();
    }

} catch (Exception $e) {
    echo (new SendMessage("Error " . $e->getMessage(), false))->getEncodedMessage();
}