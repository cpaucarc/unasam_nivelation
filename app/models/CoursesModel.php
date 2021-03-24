<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(DB_PATH . "MySqlConnection.php");

class CoursesModel
{
    private $name;
    private $id;

    public function saveNewCourses()
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "INSERT INTO courses VALUES (null, ?);";
            $pdo->prepare($sql)->execute([
                $this->name
            ]);
            return true;
        } else {
            return false;
        }
    }

    public function getAllCourses()
    {
        $conn = (new MySqlConnection())->getConnection();
        $sql = "SELECT * FROM courses ORDER BY name ASC;";

        $response['courses'] = array();
        foreach ($conn->query($sql) as $row) {
            $p = array();
            $p['id'] = $row['id'];
            $p['name'] = $row['name'];
            array_push($response['courses'], $p);
        }
        return json_encode($response);
    }

    public function getCoursesByAreaAndLastProcess($area)
    {
        $conn = (new MySqlConnection())->getConnection();
        $sql = "SELECT cr.name course, pr.denomination process
                FROM ranks AS rk
                JOIN areas AS ar ON ar.id = rk.areas_id 
                JOIN courses AS cr ON cr.id = rk.courses_id 
                JOIN process AS pr ON pr.id = rk.process_id
                
                WHERE pr.denomination = getLastProcess() AND ar.name = '".$area."';";

        $response['courses'] = array();
        foreach ($conn->query($sql) as $row) {
            $p = array();
            $p['course'] = $row['course'];
            $p['process'] = $row['process'];
            array_push($response['courses'], $p);
        }
        return json_encode($response);
    }


//    Getters and Setters
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
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


}