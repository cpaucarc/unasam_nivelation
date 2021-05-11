<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/ogcu/dirs.php');
require_once(MODEL_PATH . "CoursesModel.php");
require_once(UTIL_PATH . "SendMessage.php");

try {

    $courseID = intval($_POST['courseID']);
    $course = $_POST['course'];
    $dimension = $_POST['dimension'];

    if (isset($courseID) and isset($course)) {
        $courses = new CoursesModel();
        $courses->setName($course);
        $courses->setDimension($dimension);
        $rsp = false;

        if ($courseID === 0) {
            $rsp = $courses->saveNewCourses();
        } elseif ($courseID > 0) {
            $courses->setId($courseID);
            $rsp = $courses->updateCourse();
        }

        if ($rsp) {
            echo (new SendMessage("El registro de datos fue exitoso.", true))->getEncodedMessage();
        } else {
            echo (new SendMessage("Hubo un error al registrar los datos.", false))->getEncodedMessage();
        }

    } else {
        echo (new SendMessage("Faltan Datos", false))->getEncodedMessage();
    }
} catch (Exception $e) {
    echo (new SendMessage("Error " . $e->getMessage(), false))->getEncodedMessage();
}
