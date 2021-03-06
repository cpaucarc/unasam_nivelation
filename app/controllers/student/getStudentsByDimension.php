<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(MODEL_PATH . "StudentModel.php");
require_once(UTIL_PATH . "SendMessage.php");

try {

    if (isset($_POST['area']) and isset($_POST['process'])) {
        $student = new StudentModel();
        echo($student->getStudentsbyDimension($_POST['area'], $_POST['process']));
    } else {
        echo (new SendMessage("Error, no se pudo obtener los datos", false))->getEncodedMessage();
    }
} catch (Exception $e) {
    echo (new SendMessage("Error " . $e->getMessage(), false))->getEncodedMessage();
}
