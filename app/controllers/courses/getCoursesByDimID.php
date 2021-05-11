<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/ogcu/dirs.php');
require_once(MODEL_PATH . "CoursesModel.php");
require_once(UTIL_PATH . "SendMessage.php");

try {
    $dimID = $_POST['dimID'];

    if (isset($dimID)) {
        $courses = new CoursesModel();
        echo($courses->getCoursesByDim($dimID));
    } else {
        echo (new SendMessage("Faltan seleccionar la dimensión.", false))->getEncodedMessage();
    }
} catch (Exception $e) {
    echo (new SendMessage("Error " . $e->getMessage(), false))->getEncodedMessage();
}
