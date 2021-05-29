<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(MODEL_PATH . "graphics/studentModel.php");
$id = $_POST['id'];
$byTipe = $_POST['byTipe'];
$sm = new studentModel();
$response = $sm->getSchoolStudents($id, $byTipe);
echo json_encode($response);
