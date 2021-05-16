<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(UTIL_PATH . "Person.php");
require_once(DB_PATH . "MySqlConnection.php");
require_once(UTIL_PATH . "Question.php");


class Teacher extends Person
{
    private $teacherID;
    private $courseID; //int
    private $programID; //int
    private $genderID; //int
    private $status; //int 0:Despedido  1:Activo

    public function __construct()
    {
    }

    public function getAllTeachers()
    {
        $conn = (new MySqlConnection())->getConnection();
        $sql = "SELECT * FROM vteachers;";
        $response['teachers'] = array();
        foreach ($conn->query($sql) as $row) {
            $teacher = array();
            $teacher['id'] = $row['id']; //teacherID
            $teacher['dni'] = $row['dni'];
            $teacher['name'] = $row['name'];
            $teacher['lastname'] = $row['lastname'];
            $teacher['gender'] = $row['gender'];
            $teacher['course'] = $row['course'];
            $teacher['dimension'] = $row['dimension'];
            $teacher['program'] = $row['program'];
            $teacher['area'] = $row['area'];
            $teacher['status'] = $row['status'];
            $teacher['status_name'] = $row['status_name'];
            array_push($response['teachers'], $teacher);
        }
        return json_encode($response);
    }

    public function saveNUpdateTeacher()
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "CALL spSaveNUpdateTeacher(?, ?, ?, ?, ?, ?, ?)";
            $pdo->prepare($sql)->execute([
                $this->getTeacherID(),
                $this->getDni(),
                $this->getName(),
                $this->getLastname(),
                $this->getGenderID(),
                $this->getCourseID(),
                $this->getProgramID()
            ]);
            return true;
        } else {
            return false;
        }
    }

    public function updateStatus()
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "UPDATE teachers SET status = ? WHERE id = ?;";
            $pdo->prepare($sql)->execute([
                $this->getStatus(),
                $this->getTeacherID()
            ]);
            return true;
        } else {
            return false;
        }
    }

    /* G&S */
    public function getGenderID()
    {
        return $this->genderID;
    }

    public function setGenderID($genderID)
    {
        $this->genderID = $genderID;
        return $this;
    }

    public function getTeacherID()
    {
        return $this->teacherID;
    }

    public function setTeacherID($teacherID)
    {
        $this->teacherID = $teacherID;
        return $this;
    }

    public function getCourseID()
    {
        return $this->courseID;
    }

    public function setCourseID($courseID)
    {
        $this->courseID = $courseID;
        return $this;
    }

    public function getProgramID()
    {
        return $this->programID;
    }

    public function setProgramID($programID)
    {
        $this->programID = $programID;
        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function getDni()
    {
        return $this->dni;
    }

    public function setDni($dni)
    {
        $this->dni = $dni;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;
        return $this;
    }

}