<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(UTIL_PATH . "Tracing.php");
require_once(UTIL_PATH . "SendMessage.php");

if (isset($_POST['directorID'])) {
    $tracing = new Tracing();
    echo (new SendMessage($tracing->getProgramOfDirector($_POST['directorID']), true))->getEncodedMessage();
} else {
    echo (new SendMessage("No hay datos", false))->getEncodedMessage();
}

