<?php
//
//if (isset($_SESSION['user'])) {
//    echo 'Hay session' . $_SESSION['user'];
//} else {
//    header("Location: http://localhost/nivelation/login.php", TRUE, 301);
//    exit();
//}

include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
//require_once(MODEL_PATH . "StudentModel.php");
require_once(CONTROLLER_PATH . "StudentController.php");

$std = new StudentController();

$path = 'C:\xampp\htdocs\nivelation\public\js\prueba.json';

//var_dump($std->loadStudentsFromJSON($path));
print_r($std->loadStudentsFromJSON($path));

?>