<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(DB_PATH . "MySqlConnection.php");

class CoursesModel
{
    private $name;
    private $id;
    private $dimension;

    public function saveNewCourses()
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "INSERT INTO courses VALUES (null, ?, (SELECT id FROM dimensions WHERE name = ?));";
            $pdo->prepare($sql)->execute([
                $this->name,
                $this->dimension
            ]);
            return true;
        } else {
            return false;
        }
    }

    public function updateCourse()
    {
        $connection = new MySqlConnection();
        if ($connection and $this->id > 0) {
            $pdo = $connection->getConnection();
            $sql = "UPDATE courses SET name = ?, dimensions_id = (SELECT id FROM dimensions WHERE name = ?) WHERE id = ?;";
            $pdo->prepare($sql)->execute([
                $this->name,
                $this->dimension,
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
        $sql = "SELECT * FROM vcourses;";

        $response['courses'] = array();
        foreach ($conn->query($sql) as $row) {
            $p = array();
            $p['id'] = $row['id'];
            $p['course'] = $row['course'];
            $p['dimension'] = $row['dimension'];
            array_push($response['courses'], $p);
        }
        return json_encode($response);
    }

    public function getCoursesByDim($dimID)
    {
        $conn = (new MySqlConnection())->getConnection();
        $sql = "SELECT id, name FROM courses WHERE dimensions_id = $dimID;";

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
        $sql = "SELECT cr.name course, pr.name process
                FROM ranks AS rk
                    JOIN areas 	 AS ar ON ar.id = rk.areas_id
                    JOIN courses AS cr ON cr.id = rk.courses_id
                    JOIN process AS pr ON pr.id = rk.process_id
                WHERE pr.name = (SELECT name FROM process ORDER BY name DESC LIMIT 1) 
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
        $sql = "SELECT id, name FROM courses
                    WHERE id NOT IN (SELECT courses_id FROM ranks 
                    WHERE process_id = (SELECT id FROM process 
                    WHERE name = (SELECT name FROM process ORDER BY name DESC LIMIT 1))
                    AND areas_id = $areaID);";

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
            $sql = "INSERT INTO ranks VALUES (null, ?, ?, ?,
                    (SELECT id FROM courses WHERE name = ?),
                    (SELECT id FROM process ORDER BY name DESC LIMIT 1));";
            $pdo->prepare($sql)->execute([
                $min,
                $max,
                $areaID,
                $course
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

    /**
     * @return mixed
     */
    public function getDimension()
    {
        return $this->dimension;
    }

    /**
     * @param mixed $dimension
     * @return CoursesModel
     */
    public function setDimension($dimension)
    {
        $this->dimension = $dimension;
        return $this;
    }


}