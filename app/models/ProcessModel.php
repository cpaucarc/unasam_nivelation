<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(DB_PATH . "MySqlConnection.php");

class processModel
{
    private $id;
    private $denomination;

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
                $this->denomination
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
            $sql = "UPDATE process SET denomination = ? WHERE id = ?;";
            $pdo->prepare($sql)->execute([
                $this->denomination,
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
            $sql = "SELECT denomination FROM process WHERE id = $this->id;";

            $denomination = $conn->query($sql)->fetchColumn();

            $this->setDenomination($denomination);

            return $this;
        } else {
            return null;
        }
    }

    function getAllProcess()
    {
        $conn = (new MySqlConnection())->getConnection();
        $sql = "SELECT * FROM process;";

        $response['process'] = array();
        foreach ($conn->query($sql) as $row) {
            $p = array();
            $p['id'] = $row['id'];
            $p['denomination'] = $row['denomination'];
            array_push($response['process'], $p);
        }
        return json_encode($response);
    }

    function getLastProcess()
    {
        $conn = (new MySqlConnection())->getConnection();
        $sql = "SELECT getLastProcess();";

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

    public function getDenomination()
    {
        return $this->denomination;
    }

    public function setDenomination($denomination)
    {
        $this->denomination = $denomination;
        return $this;
    }

}