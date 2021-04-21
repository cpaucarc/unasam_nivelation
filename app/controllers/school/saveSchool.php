<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(MODEL_PATH . "SchoolsModel.php");
require_once(UTIL_PATH . "SendMessage.php");

try {
    $name = $_POST['school'];
    $areaID = intval($_POST['areaIDSch']);

    if (isset($name) and isset($areaID)) {

        $school = new SchoolsModel();
        $school->setName($name);

        if ($school->saveNewProgram($areaID)) {
            echo (new SendMessage("¡El Programa Académico " . $name . " fue guardado con exito!", true))->getEncodedMessage();
        } else {
            echo (new SendMessage("No se pudo registrar", false))->getEncodedMessage();
        }
    } else {
        echo (new SendMessage("Faltan datos ", false))->getEncodedMessage();
    }
} catch (Exception $e) {
    echo (new SendMessage("Error " . $e->getMessage(), false))->getEncodedMessage();
}