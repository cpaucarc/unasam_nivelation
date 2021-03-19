<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(MODEL_PATH . "StudentModel.php");
require_once(UTIL_PATH . "SendMessage.php");

try {
    $stdID = $_POST['stdID'];

    if (isset($stdID)) {
        $student = new StudentModel();
        $student->setId($stdID);
        echo($student->getCoursesOfStudentByID());
    } else {
        echo (new SendMessage("Error, no se pudo obtener los cursos", false))->getEncodedMessage();
    }
} catch (Exception $e) {
    echo (new SendMessage("Error " . $e->getMessage(), false))->getEncodedMessage();
}