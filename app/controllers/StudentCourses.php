<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(MODEL_PATH . "StudentModel.php");

$stID = $_POST['stID'];

$em = new StudentModel();
$em->setId($stID);
$courses = $em->getCoursesOfStudent();
echo $courses;