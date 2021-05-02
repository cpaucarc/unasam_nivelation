<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(UTIL_PATH . "Student.php");
require_once(UTIL_PATH . "Question.php");

session_start();

$students = $_SESSION['files']['students'] ?? 'null';

$amount = intval(count($students) * 0.25); //show only 25% of students

$tb_body = "";

foreach ($students as $i => $student) {
    if ($i <= $amount) {
        $tb_body .= $student->getLastname() . ' ' . $student->getName() . ' -> ' . $i;

        $questions = $student->getQuestions();
        foreach ($questions as $j => $question) {
            if ($question->getNumber() === $j++) {
                $tb_body .= '<td><small>' . $question->getResponse() . '</small></td>';
            }
        }
    }
}
echo $tb_body;
