<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(MODEL_PATH . "SchoolsModel.php");
require_once(UTIL_PATH . "SendMessage.php");

if (isset($_POST['areaID'])) {
    try {
        $areaID = $_POST['areaID'];
        $school = new SchoolsModel();
        echo($school->getSchoolsByAreaID($areaID));

    } catch (Exception $e) {
        echo (new SendMessage("Error " . $e->getMessage(), false))->getEncodedMessage();
    }
} else {
    echo (new SendMessage("No se especificó el area", false))->getEncodedMessage();
}