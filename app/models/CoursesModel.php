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

    public function updateCourse()
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "UPDATE courses SET name = ? WHERE id = ?;";
            $pdo->prepare($sql)->execute([
                $this->name,
                $this->id
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
                
                WHERE pr.denomination = (SELECT denomination FROM process ORDER BY denomination DESC LIMIT 1)
                    AND ar.name = '" . $area . "';";

        $response['courses'] = array();
        foreach ($conn->query($sql) as $row) {
            $p = array();
            $p['course'] = $row['course'];
            $p['process'] = $row['process'];
            array_push($response['courses'], $p);
        }
        return json_encode($response);
    }

    public function getCoursesNoAddedToArea($areaID)
    {
        $conn = (new MySqlConnection())->getConnection();
        $sql = "SELECT * FROM courses 
                WHERE id NOT IN (SELECT courses_id FROM ranks 
                    WHERE process_id = (SELECT id FROM process 
                    WHERE denomination = (SELECT denomination FROM process ORDER BY denomination DESC LIMIT 1)) AND areas_id = " . $areaID . ");";

        $response['courses'] = array();
        foreach ($conn->query($sql) as $row) {
            $p = array();
            $p['id'] = $row['id'];
            $p['name'] = $row['name'];
            array_push($response['courses'], $p);
        }
        return json_encode($response);
    }

    public function addCourseToArea($areaID, $course, $min, $max)
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "INSERT INTO ranks VALUES (null, 
                    (SELECT id FROM courses WHERE name = ?), ?, 
                    (SELECT id FROM process ORDER BY denomination DESC LIMIT 1), ?, ?);";
            $pdo->prepare($sql)->execute([
                $course,
                $areaID,
                $min,
                $max
            ]);
            return true;
        } else {
            return false;
        }
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