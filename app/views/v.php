<?php
session_start();

$students = $_SESSION['files']['students'] ?? 'null';

$amount = intval(count($students) * 0.25); //show only 25% of students

echo $amount;

$student = $students[0];

print_r($student);
//
//
//$questions = $students[0]->getQuestions();
//
//var_dump($questions);
?>
