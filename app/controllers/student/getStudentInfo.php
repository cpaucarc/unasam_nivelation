<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/ogcu/dirs.php');
require_once(MODEL_PATH . "StudentModel.php");
require_once(UTIL_PATH . "SendMessage.php");

try {
    $fullname = $_POST['fullname'];

    if (isset($fullname)) {
        $student = new StudentModel();

        echo($student->getStudentInfoByFullName($fullname));
    } else {
        echo (new SendMessage("Error, no se pudo encontrar la informacion", false))->getEncodedMessage();
    }

} catch (Exception $e) {
    echo (new SendMessage("Error " . $e->getMessage(), false))->getEncodedMessage();
}