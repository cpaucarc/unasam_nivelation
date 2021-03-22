<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(MODEL_PATH . "StudentModel.php");
require_once(UTIL_PATH . "SendMessage.php");

try {
    $school = $_POST['school'];
    $process = $_POST['process'];

    if (isset($school) and isset($process)) {

        $student = new StudentModel();
        echo($student->getStudentsbySchool($school, $process));

    } else {
        echo (new SendMessage("Error, no se pudo obtener los cursos", false))->getEncodedMessage();
    }
} catch (Exception $e) {
    echo (new SendMessage("Error " . $e->getMessage(), false))->getEncodedMessage();
}