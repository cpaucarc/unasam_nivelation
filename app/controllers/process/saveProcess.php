<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(MODEL_PATH . "ProcessModel.php");

$denomination = $_POST['denomination'];


if (!$denomination == '') {
    $process = new ProcessModel();
    $process->setDenomination($denomination);
    if ($process->saveProcess()) {
        echo json_encode('¡El proceso ' . $denomination . ' fue guardado con exito!');
    } else {
        echo json_encode('¡No se pudo registrar!');
    }
} else {
    echo json_encode($denomination . '¡Faltan datos!');
}