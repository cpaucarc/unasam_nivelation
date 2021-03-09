<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(MODEL_PATH . "StudentModel.php");

$fullname = $_POST['fullname'];

$student = new StudentModel();

echo($student->getStudentInfoByFullName($fullname));
