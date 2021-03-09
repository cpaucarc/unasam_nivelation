<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(MODEL_PATH . "StudentModel.php");

$pattern = $_POST['pattern'];

$student = new StudentModel();

echo($student->getStudentsLike($pattern));