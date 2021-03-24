<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(DB_PATH . "MySqlConnection.php");


class AreasModel
{
    private int $id;
    private string $area;
    private string $description;

    public function __construct()
    {
    }

    function saveNewArea()
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "INSERT INTO areas VALUES (null, ?, ?);";
            $pdo->prepare($sql)->execute([
                $this->area,
                $this->description
            ]);
            return true;
        } else {
            return false;
        }
    }

    function updateArea()
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "UPDATE areas SET name = ?, description = ? WHERE id = ?;";
            $pdo->prepare($sql)->execute([
                $this->area,
                $this->description,
                $this->id
            ]);
            return true;
        } else {
            return false;
        }
    }

    public function getAllAreas()
    {
        $conn = (new MySqlConnection())->getConnection();
        $sql = "SELECT * FROM areas ORDER BY name ASC;";

        $response['areas'] = array();
        foreach ($conn->query($sql) as $row) {
            $p = array();
            $p['id'] = $row['id'];
            $p['name'] = $row['name'];
            $p['desc'] = $row['description'];
            array_push($response['areas'], $p);
        }
        return json_encode($response);
    }

    /**
     * Getters N Setters
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
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

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): AreasModel
    {
        $this->description = $description;
        return $this;
    }


}