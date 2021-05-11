<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/ogcu/dirs.php');
require_once(DB_PATH . "MySqlConnection.php");

class processModel
{
    private $id;
    private $name;

    public function __construct()
    {
    }

    function saveProcess()
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "INSERT INTO process VALUES (null, ?);";
            $pdo->prepare($sql)->execute([
                $this->name
            ]);
            return true;
        } else {
            return false;
        }
    }

    function updateProcess()
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "UPDATE process SET name = ? WHERE id = ?;";
            $pdo->prepare($sql)->execute([
                $this->name,
                $this->id
            ]);
            return true;
        } else {
            return false;
        }
    }

    function deleteProcess()
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "DELETE FROM process WHERE id = ?;";
            $pdo->prepare($sql)->execute([
                $this->id
            ]);
            return true;
        } else {
            return false;
        }
    }

    function getProcessByID()
    {
        if (!$this->id == NULL or !$this->id == 0) {
            $conn = (new MySqlConnection())->getConnection();
            $sql = "SELECT name FROM process WHERE id = $this->id;";

            $this->setName($conn->query($sql)->fetchColumn());

            return $this;
        } else {
            return null;
        }
    }

    function getAllProcess()
    {
        $conn = (new MySqlConnection())->getConnection();
        $sql = "SELECT * FROM process ORDER BY name DESC";

        $response['process'] = array();
        foreach ($conn->query($sql) as $row) {
            $p = array();
            $p['id'] = $row['id'];
            $p['name'] = $row['name'];
            array_push($response['process'], $p);
        }
        return json_encode($response);
    }

    function getLastProcess()
    {
        $conn = (new MySqlConnection())->getConnection();
        $sql = "SELECT name FROM process ORDER BY name DESC LIMIT 1;";

        return $conn->query($sql)->fetchColumn();
    }


    /* ---------- Getters and Setter ---------- */
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

}