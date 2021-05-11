<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/ogcu/dirs.php');
require_once(MODEL_PATH . "graphics/schoolModel.php");
$process = $_POST['process'];
$sm = new schoolModel();
$response = $sm->getSchoolStudents($process);
echo json_encode($response);
