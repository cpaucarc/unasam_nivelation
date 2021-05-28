<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(UTIL_PATH . "Tracing.php");
require_once(UTIL_PATH . "SendMessage.php");

if (isset($_POST['groupID']) and isset($_POST['programID'])) {
    $tracing = new Tracing();
    echo $tracing->getStudentsOfProgramByGroup($_POST['groupID'], $_POST['programID']);
} else {
    echo (new SendMessage("No hay datos", false))->getEncodedMessage();
}