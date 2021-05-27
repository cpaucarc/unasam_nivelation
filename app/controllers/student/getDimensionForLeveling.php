<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(MODEL_PATH . "StudentModel.php");
require_once(UTIL_PATH . "SendMessage.php");

try {

    if (isset($_POST['stdID'])) {

        $student = new StudentModel();
        echo($student->getDimensionForLeveling($_POST['stdID']));

    } else {
        echo (new SendMessage("Error, no se pudo obtener los cursos", false))->getEncodedMessage();
    }

} catch (Exception $e) {
    echo (new SendMessage("Error " . $e->getMessage(), false))->getEncodedMessage();
}

