<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(MODEL_PATH . "StudentModel.php");

$student = new StudentModel();
$student->testId();


//C:\xampp\htdocs\nivelation\app\controllers
