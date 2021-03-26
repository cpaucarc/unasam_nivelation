<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(MODEL_PATH . "CoursesModel.php");
require_once(UTIL_PATH . "SendMessage.php");

try {
    $areaID = intval($_POST['areaIDCou']);
    $course = $_POST['courses'];
    $min = intval($_POST['min']);
    $max = intval($_POST['max']);

    if (isset($areaID) and isset($course) and isset($min) and isset($max)) {
        $courses = new CoursesModel();
        if ($courses->addCourseToArea($areaID, $course, $min, $max)) {
            echo (new SendMessage("Los datos se guardaron con exito.", true))->getEncodedMessage();
        } else {
            echo (new SendMessage("Hubo un error y no se pudo guardar la información.", false))->getEncodedMessage();
        }
    } else {
        echo (new SendMessage("Error, faltan datos.", false))->getEncodedMessage();
    }

} catch (Exception $e) {
    echo (new SendMessage("Error " . $e->getMessage(), false))->getEncodedMessage();
}