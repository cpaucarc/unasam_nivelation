<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(UTIL_PATH . "Teacher.php");
require_once(UTIL_PATH . "SendMessage.php");

//save if teacherID = 0, else update teacher with teacherID = #

try {
    if (isset($_POST['teacherID']) and isset($_POST['dni']) and isset($_POST['gender']) and isset($_POST['name']) and isset($_POST['lastname']) and isset($_POST['course']) and isset($_POST['program'])) {
        $teacherID = $_POST['teacherID'];
        $dni = $_POST['dni'];
        $gender = $_POST['gender']; //id
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $course = $_POST['course'];//id
        $program = $_POST['program'];//id

        $teacher = new Teacher();
        $teacher->setTeacherID($teacherID);
        $teacher->setDni($dni);
        $teacher->setName($name);
        $teacher->setLastname($lastname);
        $teacher->setGenderID($gender);
        $teacher->setCourseID($course);
        $teacher->setProgramID($program);

        $rsp = $teacher->saveNUpdateTeacher();
        if ($rsp){
            echo (new SendMessage("Los datos de $lastname $name se guardaron con éxito.", true))->getEncodedMessage();
        }else{
            echo (new SendMessage("No se pudieron guardar los datos de $lastname $name", false))->getEncodedMessage();
        }
    }else{
        echo (new SendMessage("Faltan datos", false))->getEncodedMessage();
    }
} catch (Exception $e) {
    echo (new SendMessage("Error: " . $e->getMessage(), false))->getEncodedMessage();
}

