<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(DB_PATH . "MySqlConnection.php");

class RolModel
{
    private $id;
    private $rol;

    public function getAllRoles()
    {
        $conn = (new MySqlConnection())->getConnection();
        $sql = "SELECT * FROM roles ORDER BY name ASC;";

        $response['roles'] = array();
        foreach ($conn->query($sql) as $row) {
            $rol = array();
            $rol['id'] = $row['id'];
            $rol['name'] = $row['name'];
            array_push($response['roles'], $rol);
        }
        return json_encode($response);
    }

}