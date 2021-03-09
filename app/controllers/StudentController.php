<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(MODEL_PATH . "StudentModel.php");
require_once(UTIL_PATH . "JsonReader.php");
require_once(UTIL_PATH . "Question.php");
require_once(UTIL_PATH . "SendMessage.php");

class StudentController
{
    function loadStudentsFromJSON($path)
    {
        $jsonReader = new JsonReader($path);
        $data = $jsonReader->getJsonFile();

        $students = array();
        foreach ($data as $row) {
            $student = new StudentModel();
            $student->setId(0);
            $student->setCode($row['code']);
            $student->setDni($row['dni']);
            $student->setName($row['name']);
            $student->setLastname($row['lastname']);
            $student->setSchool($row['school']);
            $questions = array();
            foreach ($row['questions'] as $q) {
                $question = new Question($q['number'], $q['response'], $q['course']);
                array_push($questions, $question);
            }
            $student->setQuestions($questions);

            array_push($students, $student);
        }
        return $students;
    }

    function saveStudentsWhitQuestions($path)
    {
        try {
            $students = $this->loadStudentsFromJSON($path);
            foreach ($students as $student) {
                $student->saveStudent();
                $student->saveQuestions();
            }
            echo (new SendMessage('¡Estudiantes y sus calificaciones guardados con exito!', true))->getEncodedMessage();
        } catch (Exception $e) {
            echo (new SendMessage($e->getMessage(), true))->getEncodedMessage();
        }
    }
}