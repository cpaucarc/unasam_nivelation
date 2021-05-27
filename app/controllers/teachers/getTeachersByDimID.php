<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(UTIL_PATH . "Teacher.php");
require_once(UTIL_PATH . "SendMessage.php");

try {
    if ($_POST['dimension']) {
        $dimID = $_POST['dimension'];
        $teacher = new Teacher();
        echo($teacher->getTeachersByDimID($dimID));
    } else {
        echo (new SendMessage("Faltan datos ", false))->getEncodedMessage();
    }
} catch (Exception $e) {
    echo (new SendMessage("Error " . $e->getMessage(), false))->getEncodedMessage();
}