<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(MODEL_PATH . "ProcessModel.php");
require_once(UTIL_PATH . "SendMessage.php");

try {
    $denomination = $_POST['denomination'];
    $procID = intval($_POST['procID']);

    if (isset($denomination) and isset($procID)) {

        $process = new ProcessModel();
        $process->setDenomination($denomination);

        if ($procID > 0) {
            $process->setId($procID);
            if ($process->updateProcess()) {
                echo (new SendMessage("¡El proceso " . $denomination . " fue actualizado con exito!", true))->getEncodedMessage();
            } else {
                echo (new SendMessage("No se pudo actualizar", false))->getEncodedMessage();
            }
        } elseif ($procID == 0) {
            if ($process->saveProcess()) {
                echo (new SendMessage("¡El proceso " . $denomination . " fue guardado con exito!", true))->getEncodedMessage();
            } else {
                echo (new SendMessage("No se pudo registrar", false))->getEncodedMessage();
            }
        }
    } else {
        echo (new SendMessage("Faltan datos ", false))->getEncodedMessage();
    }
} catch (Exception $e) {
    echo (new SendMessage("Error " . $e->getMessage(), false))->getEncodedMessage();
}