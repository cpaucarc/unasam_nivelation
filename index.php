<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');

//require_once(__DIR__ . "/app/models/StudentModel.php");
//require_once(__DIR__ . "/app/models/SchoolsModel.php");
//require_once(__DIR__ . "/app/utils/JsonReader.php");
require_once(CONTROLLER_PATH . "StudentController.php");
require_once(MODEL_PATH . "SchoolsModel.php");
require_once(MODEL_PATH . "StudentModel.php");
//require_once(__DIR__ . "/app/database/MySqlConnection.php");

//$student = new StudentModel();
//$c = new MySqlConnection();
//$c->getConnection();

//use App\Models\StudentModel;

//$em = new StudentModel();
//$em->testId();
//
//$sm = new SchoolsModel();
//die($sm->getSchools());

$path = "public/js/prueba.json";
//$jr = new JsonReader($path);
//$jr->show();

$sc = new StudentController();
$sc->saveStudentsWhitQuestions($path);

?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluation | UNASAM</title>
</head>
<body>

<h1>Titulo dccccccccccccccccccccccccccccccc</h1>

</body>
</html>