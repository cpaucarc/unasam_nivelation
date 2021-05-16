<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(UTIL_PATH . "Teacher.php");
require_once(UTIL_PATH . "SendMessage.php");

try {
    $teacher = new Teacher();
    echo($teacher->getAllTeachers());
} catch (Exception $e) {
    echo (new SendMessage("Error " . $e->getMessage(), false))->getEncodedMessage();
}
