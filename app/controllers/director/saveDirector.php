<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(UTIL_PATH . "Director.php");
require_once(UTIL_PATH . "SendMessage.php");

if (isset($_POST['directorID']) and isset($_POST['dni']) and isset($_POST['gender']) and isset($_POST['name']) and isset($_POST['lastname']) and isset($_POST['program'])) {
    $directorID = $_POST['directorID'];
    $dni = $_POST['dni'];
    $gender = $_POST['gender']; //id
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $program = $_POST['program'];//id

    $teacher = new Director();
    $teacher->setDirectorID($directorID);
    $teacher->setDni($dni);
    $teacher->setName($name);
    $teacher->setLastname($lastname);
    $teacher->setGenderID($gender);
    $teacher->setProgramID($program);

    $rsp = $teacher->saveNUpdateDirector();
    if ($rsp) {
        echo (new SendMessage("Los datos de $lastname $name se guardaron con éxito.", true))->getEncodedMessage();
    } else {
        echo (new SendMessage("No se pudieron guardar los datos de $lastname $name", false))->getEncodedMessage();
    }
} else {
    echo (new SendMessage("Faltan datos", false))->getEncodedMessage();
}