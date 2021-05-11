<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/ogcu/dirs.php');
require_once(DB_PATH . "MySqlConnection.php");

class DimensionModel
{
    private $id;
    private $dimension;

    public function saveNewDimension()
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "INSERT INTO dimensions VALUES (null, ?);";
            $pdo->prepare($sql)->execute([
                $this->dimension
            ]);
            return true;
        } else {
            return false;
        }
    }

    public function getAllDimensions()
    {
        $conn = (new MySqlConnection())->getConnection();
        $sql = "SELECT * FROM dimensions ORDER BY name;";

        $response['dimensions'] = array();
        foreach ($conn->query($sql) as $row) {
            $p = array();
            $p['id'] = $row['id'];
            $p['name'] = $row['name'];
            array_push($response['dimensions'], $p);
        }
        return json_encode($response);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return DimensionModel
     */
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
     * @return DimensionModel
     */
    public function setDimension($dimension)
    {
        $this->dimension = $dimension;
        return $this;
    }


}