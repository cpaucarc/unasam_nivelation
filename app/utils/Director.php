<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(UTIL_PATH . "Person.php");
require_once(DB_PATH . "MySqlConnection.php");
require_once(UTIL_PATH . "Question.php");


class Director extends Person
{
    private $directorID;
    private $programID; //int
    private $genderID; //int
    private $status;

    public function __construct()
    {
    }

    public function getAllDirectors()
    {
        $conn = (new MySqlConnection())->getConnection();
        $sql = "SELECT id, dni, lastname, name, gender, program, area FROM vdirectors ORDER BY area ASC, program ASC, lastname ASC;";
        $response['directors'] = array();
        foreach ($conn->query($sql) as $row) {
            $teacher = array();
            $teacher['id'] = $row['id']; //teacherID
            $teacher['dni'] = $row['dni'];
            $teacher['lastname'] = $row['lastname'];
            $teacher['name'] = $row['name'];
            $teacher['gender'] = $row['gender'];
            $teacher['program'] = $row['program'];
            $teacher['area'] = $row['area'];
            array_push($response['directors'], $teacher);
        }
        return json_encode($response);
    }
//spSaveNUpdateDirector`(in directorID smallint, _dni varchar(8), _name varchar(45),
// _lastname varchar(45), genderID tinyint, programID tinyint)
    public function saveNUpdateDirector()
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "CALL spSaveNUpdateDirector(?, ?, ?, ?, ?, ?)";
            $pdo->prepare($sql)->execute([
                $this->getDirectorID(),
                $this->getDni(),
                $this->getName(),
                $this->getLastname(),
                $this->getGenderID(),
                $this->getProgramID()
            ]);
            return true;
        } else {
            return false;
        }
    }


    /* G & S */
    public function getDirectorID()
    {
        return $this->directorID;
    }

    public function setDirectorID($directorID)
    {
        $this->directorID = $directorID;
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

    public function getGenderID()
    {
        return $this->genderID;
    }

    public function setGenderID($genderID)
    {
        $this->genderID = $genderID;
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

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
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
    } //int 0:Despedido  1:Activo

}