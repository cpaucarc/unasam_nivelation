<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(MODEL_PATH . "ProcessModel.php");
require_once(UTIL_PATH . "SendMessage.php");

try {

    if (isset($_POST['denomination']) and isset($_POST['procID']) and isset($_POST['minPercent']) and isset($_POST['minQlf'])) {
        $denomination = $_POST['denomination'];
        $procID = intval($_POST['procID']);
        $minPercent = intval($_POST['minPercent']);
        $minQlf = intval($_POST['minQlf']);

        if ($minPercent >= 0 and $minPercent <= 100) {
            if ($minQlf >= 0 and $minQlf <= 20) {
                $process = new ProcessModel();
                $process->setName($denomination);
                $process->setPercent($minPercent);
                $process->setQualify($minQlf);

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
                echo (new SendMessage("La nota minima para aprobar debe encontrarse entre 0 y 20.", false))->getEncodedMessage();
            }
        } else {
            echo (new SendMessage("El porcentaje de evaluacion debe encontrarse entre 0 y 100, de preferencia debe ser mayor a 25%.", false))->getEncodedMessage();
        }


    } else {
        echo (new SendMessage("Faltan datos ", false))->getEncodedMessage();
    }
} catch (Exception $e) {
    echo (new SendMessage("Error " . $e->getMessage(), false))->getEncodedMessage();
}