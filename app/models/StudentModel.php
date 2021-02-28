<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(DB_PATH . "MySqlConnection.php");
require_once(UTIL_PATH . "Question.php");

class StudentModel
{
    private $name;
    private $lastname;
    private $dni;
    private $code;
    private $school;
    private $id;
    private $questions;

    public function __construct()
    {
    }

    public function saveStudent()
    {
        $connection = new MySqlConnection();
        if ($connection and $this->id == 0) {
            $pdo = $connection->getConnection();
            $sql = "CALL spSaveStudent(?, ?, ?, ?, ?)";
            $pdo->prepare($sql)->execute([
                $this->name,
                $this->lastname,
                $this->dni,
                $this->code,
                $this->school
            ]);

            $id_value = $pdo->query("SELECT getStudentID('$this->dni');");
            foreach ($id_value as $idv) {
                $this->setId(intval($idv[0]));
            }

            return true;
        } else {
            return false;
        }
    }

    public function saveQuestions()
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "CALL spSaveQuestionsByStudent(?, ?, ?, ?)";

            foreach ($this->questions as $question) {
                $pdo->prepare($sql)->execute([
                    $question->getNumber(),
                    $question->getResponse(),
                    $question->getCourse(),
                    $this->id
                ]);
            }
            return true;
        } else {
            return false;
        }

    }

    public function getStudents()
    {
        return 'ToDo';
    }

    /*-------------------------- Getters and Setters --------------------------*/
    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    public function getDni()
    {
        return $this->dni;
    }

    public function setDni(string $dni)
    {
        $this->dni = $dni;
        return $this;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setCode(string $code)
    {
        $this->code = $code;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    public function setQuestions(array $questions)
    {
        $this->questions = $questions;
        return $this;
    }

    public function getQuestions()
    {
        return $this->questions;
    }

    public function getSchool()
    {
        return $this->school;
    }

    public function setSchool($school)
    {
        $this->school = $school;
        return $this;
    }


}