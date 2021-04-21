<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(DB_PATH . "MySqlConnection.php");

class RanksModel
{
    private $id;
    private $course;
    private $area;
    private $process;
    private $minimal;
    private $maximum;

    public function __construct()
    {
    }

    function saveNewRank()
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "CALL saveNewRankByName(?, ?, ?, ?, ?);";
            $pdo->prepare($sql)->execute([
                $this->course,
                $this->area,
                $this->process,
                $this->minimal,
                $this->maximum
            ]);
            return true;
        } else {
            return false;
        }
    }

    function updateRankValues()
    {
        if (intval($this->id) > 0) {
            $connection = new MySqlConnection();
            if ($connection) {
                $pdo = $connection->getConnection();
                $sql = "UPDATE ranks SET minimum = ?, recommended = ? WHERE id = ?";
                $pdo->prepare($sql)->execute([
                    $this->minimal,
                    $this->maximum,
                    $this->id
                ]);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function getAllRanksByProcessID($process_denomination)
    {
        $conn = (new MySqlConnection())->getConnection();
        if (isset($process_denomination)) {
            $sql = sprintf("SELECT * FROM vranks WHERE processid = '%s';", $process_denomination);
            $response['ranks'] = array();
            foreach ($conn->query($sql) as $row) {
                $rank = array();
                $rank['id'] = $row['id'];
                $rank['course'] = $row['course'];
                $rank['area'] = $row['area'];
                $rank['process'] = $row['process'];
                $rank['minimum'] = $row['minimum'];
                $rank['recommended'] = $row['recommended'];
                array_push($response['ranks'], $rank);
            }
            return json_encode($response);
        } else {
            return json_encode('{"error" : "No hay datos"}');
        }


    }

    /* ------------ Getters and Setters ------------ */

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getCourse()
    {
        return $this->course;
    }

    public function setCourse($course)
    {
        $this->course = $course;
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

    public function getProcess()
    {
        return $this->process;
    }

    public function setProcess($process)
    {
        $this->process = $process;
        return $this;
    }

    public function getMinimal()
    {
        return $this->minimal;
    }

    public function setMinimal($minimal)
    {
        $this->minimal = $minimal;
        return $this;
    }

    public function getMaximum()
    {
        return $this->maximum;
    }

    public function setMaximum($maximum)
    {
        $this->maximum = $maximum;
        return $this;
    }

}