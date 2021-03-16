<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(MODEL_PATH . "ProcessModel.php");
require_once(UTIL_PATH . "SendMessage.php");

try {
    $denomination = $_POST['denomination'];

    if (!$denomination == '') {

        $process = new ProcessModel();
        $process->setDenomination($denomination);

        if ($process->saveProcess()) {
            echo (new SendMessage("¡El proceso " . $denomination . " fue guardado con exito!", false))->getEncodedMessage();
        } else {
            echo (new SendMessage("No se pudo registrar", false))->getEncodedMessage();
        }

    } else {
        echo (new SendMessage("Faltan datos ", false))->getEncodedMessage();
    }
} catch (Exception $e) {
    echo (new SendMessage("Error " . $e->getMessage(), false))->getEncodedMessage();
}