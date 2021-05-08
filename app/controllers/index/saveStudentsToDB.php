<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(DB_PATH . "MySqlConnection.php");
require_once(UTIL_PATH . "Student.php");
require_once(UTIL_PATH . "Question.php");

session_start();
$students = $_SESSION['files']['students'] ?? null;

if (!is_null($students)) {

    $total = count($students);
    $conn = (new MySqlConnection())->getConnection();

    $sql = "CALL spCountCoursesMissing()";
    $ex = $conn->prepare($sql);
    $ex->execute();
    $missingCourses = intval($ex->fetchColumn());

    if ($missingCourses === 0) {

        foreach ($students as $i => $student) {
//            echo $student->getName();
            $student->saveStudentToDB();
            $student->saveQuestionsToDB();
            $student->doClasificationOfCourses();
            echo ($i + 1) . ' de ' . $total . ' -> ' . round((($i + 1) / $total) * 100) . '%';
        }

        echo 'Completado';

    } else {
        echo "Hay $missingCourses cursos que no poseen rango minimo y recomendado.";
    }
} else {
    echo 'No hay información que se pueda guardar.';
}


