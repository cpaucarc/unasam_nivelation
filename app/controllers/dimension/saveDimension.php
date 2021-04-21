<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(MODEL_PATH . "DimensionModel.php");
require_once(UTIL_PATH . "SendMessage.php");

try {
    $dimension = $_POST['dimension'];
    if (isset($dimension)) {
        $dimensionModel = new DimensionModel();
        $dimensionModel->setDimension($dimension);
        $rsp = $dimensionModel->saveNewDimension();
        if ($rsp) {
            echo (new SendMessage("El registro de datos fue exitoso.", true))->getEncodedMessage();
        } else {
            echo (new SendMessage("Hubo un error al registrar.", false))->getEncodedMessage();
        }
    } else {
        echo (new SendMessage("Faltan datos.", false))->getEncodedMessage();
    }
} catch (Exception $e) {
    echo (new SendMessage("Error:" . $e, false))->getEncodedMessage();
}
