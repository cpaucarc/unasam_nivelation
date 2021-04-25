<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(MODEL_PATH . "graphics/studentModel.php");
$process = $_POST['process'];
$sm = new courseModel();
$response = $sm->getSchoolStudents($process);
echo json_encode($response);
