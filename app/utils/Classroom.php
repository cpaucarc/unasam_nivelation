<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(DB_PATH . "MySqlConnection.php");


class Classroom
{


    function createNewGroup($procID, $areaID, $dimID, $dateStart, $dateEnd)
    {

        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "INSERT INTO groups (areas_id, date_start, date_end, dimensions_id, process_id) VALUES (?, ?, ?, ?, ?);";
            return $pdo->prepare($sql)->execute([
                $areaID,
                $dateStart,
                $dateEnd,
                $dimID,
                $procID
            ]);
        } else {
            return false;
        }

    }

    function verifyIfExistGroup($procID, $areaID, $dimID)
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "SELECT EXISTS(SELECT 1 FROM groups WHERE areas_id = " . $areaID . " AND dimensions_id = " . $dimID . " AND process_id = " . $procID . ");";

            $exist = $pdo->query($sql);
            return intval($exist->fetchColumn()) === 1;

        } else {
            return false;
        }
    }

    function getGroupID($procID, $areaID, $dimID)
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "SELECT id FROM groups WHERE areas_id = " . $areaID . " AND dimensions_id = " . $dimID . " AND process_id = " . $procID . ";";
            $exist = $pdo->query($sql);
            return intval($exist->fetchColumn());
        } else {
            return false;
        }
    }

    public function getAllGroups()
    {
        $conn = (new MySqlConnection())->getConnection();
        $sql = "SELECT * FROM vgroups ORDER BY date_end DESC;";
        $response['groups'] = array();
        foreach ($conn->query($sql) as $row) {
            $p = array();
            $p['id'] = $row['id'];
            $p['teacher'] = $row['teacher'];
            $p['dimension'] = $row['dimension'];
            $p['area'] = $row['area'];
            $p['process'] = $row['process'];
            $p['amount'] = $row['amount'];
            $p['date_start'] = $row['date_start'];
            $p['date_end'] = $row['date_end'];
            $p['stat'] = $row['stat'];
            array_push($response['groups'], $p);
        }
        return json_encode($response);
    }

    public function getAllRooms()
    {
        $conn = (new MySqlConnection())->getConnection();
        $sql = "SELECT id, name FROM classrooms ORDER BY name ASC;";
        $response['rooms'] = array();
        foreach ($conn->query($sql) as $row) {
            $p = array();
            $p['id'] = $row['id'];
            $p['name'] = $row['name'];
            array_push($response['rooms'], $p);
        }
        return json_encode($response);
    }
}