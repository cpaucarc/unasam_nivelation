<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/ogcu/dirs.php');
require_once(MODEL_PATH . "SchoolsModel.php");
require_once(UTIL_PATH . "SendMessage.php");

if (isset($_POST['area'])) {
    try {

        $area = $_POST['area'];
        $school = new SchoolsModel();
        $school->setArea($area);
        echo($school->getSchoolsByArea());

    } catch (Exception $e) {
        echo (new SendMessage("Error " . $e->getMessage(), false))->getEncodedMessage();
    }
} else {
    echo (new SendMessage("No se especificó el area", false))->getEncodedMessage();
}