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
        $sql = "SELECT * FROM vteachers ORDER BY status DESC, area ASC, program ASC, course ASC, lastname ASC;";
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

    public function getAllTeachersParcial()
    {
        $conn = (new MySqlConnection())->getConnection();
        $sql = "SELECT id, dni, concat(lastname,' ', name) teacher, dimension FROM vteachers ORDER BY dimension ASC, teacher ASC;";
        $response['teachers'] = array();
        foreach ($conn->query($sql) as $row) {
            $teacher = array();
            $teacher['id'] = $row['id']; //teacherID
            $teacher['dni'] = $row['dni'];
            $teacher['teacher'] = $row['teacher'];
            $teacher['course'] = $row['dimension'];
            array_push($response['teachers'], $teacher);
        }
        return json_encode($response);
    }

    public function getTeachersByDimID($dimID)
    {
        $conn = (new MySqlConnection())->getConnection();
        $sql = "SELECT id, (SELECT dni FROM people where id = people_id) as dni, (SELECT concat(lastname, ' ', name) FROM people where id = people_id) teacher, (SELECT name FROM courses WHERE id = courses_id) course FROM teachers WHERE courses_id IN (SELECT id FROM courses WHERE dimensions_id = $dimID) AND status = 1;";
        $response['teachers'] = array();
        foreach ($conn->query($sql) as $row) {
            $teacher = array();
            $teacher['id'] = $row['id']; //teacherID
            $teacher['dni'] = $row['dni'];
            $teacher['teacher'] = $row['teacher'];
            $teacher['course'] = $row['course'];
            array_push($response['teachers'], $teacher);
        }
        return json_encode($response);
    }

    public function getCoursesOfTeacher($teacherID)
    {
        $conn = (new MySqlConnection())->getConnection();
        $sql = "SELECT 
                    gr.id AS groupID,
                    gr.name AS groupName,
                    dm.name as dimensionName,
                    ar.name as areaName,
                    (SELECT count(1) FROM student_group WHERE groups_id = gr.id) as numStudents
                FROM groups AS gr
                JOIN dimensions AS dm ON dm.id = gr.dimensions_id
                JOIN areas AS ar ON ar.id = gr.areas_id
                WHERE gr.teachers_id = $teacherID ORDER BY ar.name ASC, gr.name ASC;";
        $response['courses'] = array();
        foreach ($conn->query($sql) as $row) {
            $teacher = array();
            $teacher['groupID'] = $row['groupID']; //teacherID
            $teacher['groupName'] = $row['groupName'];
            $teacher['dimensionName'] = $row['dimensionName'];
            $teacher['areaName'] = $row['areaName'];
            $teacher['numStudents'] = $row['numStudents'];
            array_push($response['courses'], $teacher);
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