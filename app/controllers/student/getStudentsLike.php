<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/ogcu/dirs.php');
require_once(MODEL_PATH . "StudentModel.php");
require_once(UTIL_PATH . "SendMessage.php");

try {
    $pattern = $_POST['pattern'];
    if (isset($pattern)) {
        $student = new StudentModel();
        echo($student->getStudentsLike($pattern));
    } else {
        echo (new SendMessage("Error, no se pudo la informacion", false))->getEncodedMessage();
    }
} catch (Exception $e) {
    echo (new SendMessage("Error " . $e->getMessage(), false))->getEncodedMessage();
}