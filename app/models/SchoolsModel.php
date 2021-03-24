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


    function saveNewSchool($areaID)
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "INSERT INTO schools VALUES (null, ?, ?);";
            $pdo->prepare($sql)->execute([
                $this->name,
                $areaID
            ]);
            return true;
        } else {
            return false;
        }
    }

    function updateSchool()
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "UPDATE schools SET name = ? WHERE id = ?;";
            $pdo->prepare($sql)->execute([
                $this->denomination,
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
            $sql = "DELETE FROM schools WHERE id = ?;";
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
        $sql = "SELECT * FROM schools;";

        $response['schools'] = array();

        foreach ($conn->query($sql) as $row) {
            $school = array();

            $school['name'] = $row['name'];
            $school['id'] = $row['id'];
            $school['areas_id'] = $row['areas_id'];

            array_push($response['schools'], $school);
        }
        return json_encode($response);
    }

    public function getSchoolsByArea()
    {
        $conn = (new MySqlConnection())->getConnection();
        $sql = "SELECT * FROM schools WHERE areas_id = (SELECT id FROM areas WHERE name = '" . $this->area . "');;";

        $response['schools'] = array();

        foreach ($conn->query($sql) as $row) {
            $school = array();

            $school['name'] = $row['name'];
            $school['id'] = $row['id'];
            $school['areas_id'] = $row['areas_id'];

            array_push($response['schools'], $school);
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