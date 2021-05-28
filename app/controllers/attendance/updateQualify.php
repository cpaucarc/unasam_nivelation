<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(UTIL_PATH . "Attendance.php");
require_once(UTIL_PATH . "SendMessage.php");

if (isset($_POST['changeQlfID']) and isset($_POST['currentQlf'])) {
    $qlfID = intval($_POST['changeQlfID']);
    $qlf = intval($_POST['currentQlf']);

    if ($qlf >= 0 and $qlf <= 20) {
        if ($qlfID > 0) {
            $att = new Attendance();
            if ($att->updateQualification($qlf, $qlfID)) {
                echo (new SendMessage("Se actualizo la calificación correctamente", true))->getEncodedMessage();
            } else {
                echo (new SendMessage("Hubo un error, y no se pudo actualizar los datos", false))->getEncodedMessage();
            }
        } else {
            echo (new SendMessage("Falta información", false))->getEncodedMessage();
        }
    } else {
        echo (new SendMessage("La calificación debe etar entre 0 y 20, usted puso $qlf", false))->getEncodedMessage();
    }
} else {
    echo (new SendMessage("No hay datos", false))->getEncodedMessage();
}
