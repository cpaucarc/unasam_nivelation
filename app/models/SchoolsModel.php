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

}