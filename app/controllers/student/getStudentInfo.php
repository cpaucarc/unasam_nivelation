<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(MODEL_PATH . "StudentModel.php");

$stdID = intval($_POST['stdID']);

$student = new StudentModel();
$student->setId($stdID);

echo $student->findByID();