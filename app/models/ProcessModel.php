<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(DB_PATH . "MySqlConnection.php");

class processModel
{
    private $id;
    private $name;
    private $percent;
    private $qualify;

    public function __construct()
    {
    }

    function saveProcess()
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "INSERT INTO process (name, percent, qualification_min) VALUES (?, ?, ?);";
            $pdo->prepare($sql)->execute([
                $this->getName(),
                $this->getPercent(),
                $this->getQualify()
            ]);

            $sql = "SELECT id FROM process WHERE name = '" . $this->getName() . "';";
            $this->setId(intval($pdo->query($sql)->fetchColumn()));

            $courses = $this->getCoursesID();
            $areas = $this->getAreasID();
            $dimensions = $this->getDimensionsID();
            $min = round(intval($this->getPercent()) * 0.65);
            $max = intval($this->getPercent());

            $query = "INSERT INTO ranks (minimum, recommended, areas_id, courses_id, process_id) VALUES ";
            foreach ($courses as $course) {
                foreach ($areas as $area) {
                    $query .= "($min, $max, $area, $course, " . $this->getId() . "), ";
                }
            }
            $query = substr($query, 0, strlen($query) - 2) . ";";

            $pdo->query($query);

            $query = "INSERT INTO dimension_ranks (min, areas_id, dimensions_id, process_id) VALUES ";
            foreach ($dimensions as $dimension) {
                foreach ($areas as $area) {
                    $query .= "($max, $area, $dimension, " . $this->getId() . "), ";
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
            $sql = "UPDATE process SET name = ?, percent = ?, qualification_min = ?  WHERE id = ?;";
            $pdo->prepare($sql)->execute([
                $this->getName(),
                $this->getPercent(),
                $this->getQualify(),
                $this->getId()
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
            $p['percent'] = $row['percent'];
            $p['qualification'] = $row['qualification_min'];
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

    public function getPercent()
    {
        return $this->percent ?? 40;
    }

    public function setPercent($percent)
    {
        $this->percent = $percent;
        return $this;
    }

    public function getQualify()
    {
        return $this->qualify ?? 14;
    }

    public function setQualify($qualify)
    {
        $this->qualify = $qualify;
        return $this;
    }


}