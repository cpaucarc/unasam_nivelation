<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(MODEL_PATH . "graphics/courseModel.php");
$process = $_POST['process'];
$status = $_POST['status'];
$sm = new courseModel();
$response = $sm->getSchoolStudents($status, $process);
echo json_encode($response);
