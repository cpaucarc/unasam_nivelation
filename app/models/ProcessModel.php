<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
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
                $this->getName()
            ]);

            $sql = "SELECT id FROM process WHERE name = '" . $this->getName() . "';";
            $this->setId(intval($pdo->query($sql)->fetchColumn()));

            $courses = $this->getCoursesID();
            $areas = $this->getAreasID();
            $dimensions = $this->getDimensionsID();
            $min = 20;
            $max = 40;

            $query = "INSERT INTO ranks VALUES ";
            foreach ($courses as $course) {
                foreach ($areas as $area) {
                    $query .= "(null, $min, $max, $area, $course, " . $this->getId() . "), ";
                }
            }
            $query = substr($query, 0, strlen($query) - 2) . ";";

            $pdo->query($query);

            $query = "INSERT INTO dimension_ranks VALUES ";
            foreach ($dimensions as $dimension) {
                foreach ($areas as $area) { //2:mate, 3:comunc, 7:tecn estudio (dimensions -> BD)
                    if (intval($dimension) === 2 or intval($dimension) === 3 or intval($dimension) === 7) {
                        $query .= "(null, $max, $area, $dimension, " . $this->getId() . "), ";
                    } else {
                        $query .= "(null, 0, $area, $dimension, " . $this->getId() . "), ";
                    }
                }
            }
            $query = substr($query, 0, strlen($query) - 2) . ";";

            $pdo->query($query);

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

    private function getCoursesID()
    {
        $connection = new MySqlConnection();
        $pdo = $connection->getConnection();

        $sql = "SELECT id FROM courses";
        $courses = array();
        foreach ($pdo->query($sql) as $row) {
            array_push($courses, $row['id']);
        }

        return $courses;
    }

    private function getAreasID()
    {
        $connection = new MySqlConnection();
        $pdo = $connection->getConnection();

        $sql = "SELECT id FROM areas";
        $areas = array();
        foreach ($pdo->query($sql) as $row) {
            array_push($areas, $row['id']);
        }

        return $areas;
    }

    private function getDimensionsID()
    {
        $connection = new MySqlConnection();
        $pdo = $connection->getConnection();

        $sql = "SELECT id FROM dimensions";
        $dimensions = array();
        foreach ($pdo->query($sql) as $row) {
            array_push($dimensions, $row['id']);
        }

        return $dimensions;
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