<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/ogcu/dirs.php');
require_once(MODEL_PATH . "StudentModel.php");
require_once(UTIL_PATH . "SendMessage.php");

try {
    $area = $_POST['area'];
    $course = $_POST['course'];
    $process = $_POST['process'];

    if (isset($area) and isset($course) and isset($process)) {
        $student = new StudentModel();

        echo($student->getStudentsbyCourse($area, $course, $process));
    } else {
        echo (new SendMessage("Error, no se pudo obtener los cursos", false))->getEncodedMessage();
    }
} catch (Exception $e) {
    echo (new SendMessage("Error " . $e->getMessage(), false))->getEncodedMessage();
}
