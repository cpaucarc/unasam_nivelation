<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/ogcu/dirs.php');
require_once(CONTROLLER_PATH . "StudentController.php");
require_once(UTIL_PATH . "SendMessage.php");

if (isset($_POST['path'])) {
    $path = $_POST['path'];

    $student = new StudentController();

    $response = $student->saveStudentsWhitQuestions($path);

    if ($response['response']) {
        echo (new SendMessage('Los datos de los estudiantes se guardaron con exito', true))->getEncodedMessage();
    } else {
        echo (new SendMessage($response['message'], false))->getEncodedMessage();
    }
}