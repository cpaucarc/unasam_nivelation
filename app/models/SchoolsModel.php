<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(DB_PATH . "MySqlConnection.php");

class SchoolsModel
{
    private $id;
    private $name;
    private $area;

    public function __construct()
    {
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