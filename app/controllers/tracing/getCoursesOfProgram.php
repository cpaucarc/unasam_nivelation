<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(UTIL_PATH . "Tracing.php");
require_once(UTIL_PATH . "SendMessage.php");

if (isset($_POST['proccessID']) and isset($_POST['programID'])) {
    $tracing = new Tracing();
    echo $tracing->getCoursesOfProgram($_POST['proccessID'], $_POST['programID']);
} else {
    echo (new SendMessage("No hay datos", false))->getEncodedMessage();
}
