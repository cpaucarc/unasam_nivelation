<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(DB_PATH . "MySqlConnection.php");
require_once(UTIL_PATH . "Student.php");
require_once(UTIL_PATH . "Question.php");

session_start();
$students = $_SESSION['files']['students'] ?? null;

$saveSuccess = 0;
$saveFailed = array();
$finalResponse = array();

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
            if ($student->saveStudentToDB()) {
                if ($student->saveQuestionsToDB()) {
                    if ($student->doClasificationOfCourses()) {
                        $saveSuccess++;
                    } else {
                        array_push($saveFailed, array(
                            'num' => $student->getNum(),
                            'name' => ucwords(strtolower($student->getLastname() . ' ' . $student->getName())),
                            'code' => $student->getCode()
                        ));
                    }
                } else {
                    array_push($saveFailed, array(
                        'num' => $student->getNum(),
                        'name' => ucwords(strtolower($student->getLastname() . ' ' . $student->getName())),
                        'code' => $student->getCode()
                    ));
                }
            } else {
                array_push($saveFailed, array(
                    'num' => $student->getNum(),
                    'name' => ucwords(strtolower($student->getLastname() . ' ' . $student->getName())),
                    'code' => $student->getCode()
                ));
            }
        }

        array_push($finalResponse, array(
            'students' => $saveFailed,
            'failed' => count($saveFailed),
            'success' => $saveSuccess,
            'total' => $total
        ));

        echo json_encode([
            'response' => $finalResponse,
            'message' => 'Se procesó correctamente todos los datos.',
            'status' => 1
        ]);

    } else {
        echo json_encode([
            'response' => null,
            'message' => "Hay $missingCourses cursos que no poseen rango minimo y recomendado.",
            'status' => 0
        ]);
    }
} else {
    echo json_encode([
        'response' => null,
        'message' => 'No hay información que se pueda guardar.',
        'status' => 0
    ]);
}


