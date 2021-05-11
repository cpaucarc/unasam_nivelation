<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/ogcu/dirs.php');
require_once(MODEL_PATH . "AreasModel.php");
require_once(UTIL_PATH . "SendMessage.php");

try {
    $name = $_POST['area'];
    $desc = $_POST['desc'];

    if (isset($name) and isset($desc)) {

        $area = new AreasModel();
        $area->setArea($name);
        $area->setDescription($desc);

        if ($area->saveNewArea()) {
            echo (new SendMessage("¡El area " . $name . " fue guardado con exito!", true))->getEncodedMessage();
        } else {
            echo (new SendMessage("No se pudo registrar", false))->getEncodedMessage();
        }
    } else {
        echo (new SendMessage("Faltan datos ", false))->getEncodedMessage();
    }
} catch (Exception $e) {
    echo (new SendMessage("Error " . $e->getMessage(), false))->getEncodedMessage();
}
