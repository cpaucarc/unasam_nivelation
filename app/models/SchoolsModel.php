<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(DB_PATH . "MySqlConnection.php");

class SchoolsModel
{
    private int $id;
    private string $name;
    private string $area;

    public function __construct()
    {
    }


    function saveNewProgram($areaID)
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "INSERT INTO programs VALUES (null, ?, ?);";
            $pdo->prepare($sql)->execute([
                $this->name,
                $areaID
            ]);
            return true;
        } else {
            return false;
        }
    }

    function updateProgram()
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "UPDATE programs SET name = ? WHERE id = ?;";
            $pdo->prepare($sql)->execute([
                $this->name,
                $this->id
            ]);
            return true;
        } else {
            return false;
        }
    }

    function deleteSchool()
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "DELETE FROM programs WHERE id = ?;";
            $pdo->prepare($sql)->execute([
                $this->id
            ]);
            return true;
        } else {
            return false;
        }
    }

    public function getSchools()
    {
        $conn = (new MySqlConnection())->getConnection();
        $sql = "SELECT * FROM programs;";

        $response['programs'] = array();

        foreach ($conn->query($sql) as $row) {
            $school = array();

            $school['name'] = $row['name'];
            $school['id'] = $row['id'];
            $school['areas_id'] = $row['areas_id'];

            array_push($response['programs'], $school);
        }
        return json_encode($response);
    }

    public function getSchoolsByArea()
    {
        $conn = (new MySqlConnection())->getConnection();
        $sql = "SELECT * FROM programs WHERE areas_id = (SELECT id FROM areas WHERE name = '" . $this->area . "');;";

        $response['programs'] = array();

        foreach ($conn->query($sql) as $row) {
            $school = array();

            $school['name'] = $row['name'];
            $school['id'] = $row['id'];
            $school['areas_id'] = $row['areas_id'];

            array_push($response['programs'], $school);
        }
        return json_encode($response);
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

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getArea()
    {
        return $this->area;
    }

    public function setArea($area)
    {
        $this->area = $area;
        return $this;
    }


}