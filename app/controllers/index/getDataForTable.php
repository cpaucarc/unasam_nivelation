<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/ogcu/dirs.php');
require_once(UTIL_PATH . "Student.php");
require_once(UTIL_PATH . "Question.php");

session_start();

$students = $_SESSION['files']['students'] ?? null;

if (!is_null($students)) {
    $count = count($students);

    if ($count < 50) {
        $amount = $count;
    } else {
        $amount = $count > 700 ? intval($count * 0.10) : intval($count * 0.17);//solo se muestra el 10% o 17% de los estudiantes en la vista previa
    }

    $tb_body = '';
    $row_start = '<td><small>';
    $row_end = '</small></td>';

    foreach ($students as $i => $student) {
        if ($i < $amount) {

            $tb_body .= '<tr>';
            $tb_body .= $row_start . $student->getNum() . $row_end;
            $tb_body .= $row_start . $student->getDni() . $row_end;
            $tb_body .= $row_start . $student->getPostulantCode() . $row_end;
            $tb_body .= $row_start . $student->getCode() . $row_end;
            $tb_body .= $row_start . $student->getLastname() . $row_end;
            $tb_body .= $row_start . $student->getName() . $row_end;
            $tb_body .= $row_start . $student->getGender() . $row_end;
            $tb_body .= $row_start . $student->getArea() . $row_end;
            $tb_body .= $row_start . $student->getProgram() . $row_end;
            $tb_body .= $row_start . $student->getOmg() . $row_end;

            $questions = $student->getQuestions();
            foreach ($questions as $j => $question) {
                $tb_body .= $row_start . $question->getResponse() . $row_end;
            }

            $tb_body .= $row_start . $student->getScore() . $row_end;
            $tb_body .= $row_start . $student->getBlank() . $row_end;
            $tb_body .= $row_start . $student->getGood() . $row_end;
            $tb_body .= $row_start . $student->getBad() . $row_end;
            $tb_body .= "</tr>";
        } else {
            break;
        }
    }
    echo $tb_body;
} else {
    echo 'No hay información para mostrar.';
}


