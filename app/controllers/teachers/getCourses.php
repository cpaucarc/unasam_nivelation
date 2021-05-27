<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(UTIL_PATH . "Teacher.php");
require_once(UTIL_PATH . "SendMessage.php");

try {
    if (isset($_POST['teacherID'])) {
        $teacherID = intval($_POST['teacherID']);
        if ($teacherID > 0) {
            $teacher = new Teacher();
            echo($teacher->getCoursesOfTeacher($teacherID));
        } else {
            echo (new SendMessage("Error, no se especificó el docente", false))->getEncodedMessage();
        }
    } else {
        echo (new SendMessage("Error, no se especificó el docente", false))->getEncodedMessage();
    }
} catch (Exception $e) {
    echo (new SendMessage("Error " . $e->getMessage(), false))->getEncodedMessage();
}