<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(DB_PATH . "MySqlConnection.php");
require_once(UTIL_PATH . "Question.php");

class StudentModel
{
    private $name;
    private $lastname;
    private $dni;
    private $code;
    private $school;
    private $id; // This is StudentID, not PersonID
    private $questions;

    public function __construct()
    {
    }

    public function saveStudent()
    {
        $connection = new MySqlConnection();
        if ($connection and $this->id == 0) {
            $pdo = $connection->getConnection();
            $sql = "CALL spSaveStudent(?, ?, ?, ?, ?)";
            $pdo->prepare($sql)->execute([
                $this->name,
                $this->lastname,
                $this->dni,
                $this->code,
                $this->school
            ]);

            $id_value = $pdo->query("SELECT id FROM students WHERE persons_id = (SELECT id FROM persons WHERE dni = '$this->dni');");
            $id = is_null($id_value->fetchColumn()) ? 0 : intval($id_value->fetchColumn());
            $this->setId($id);
            return true;
        } else {
            return false;
        }
    }

    public function saveQuestions()
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "CALL spSaveQuestionsByStudent(?, ?, ?, ?)";

            foreach ($this->questions as $question) {
                $pdo->prepare($sql)->execute([
                    $question->getNumber(),
                    $question->getResponse(),
                    $this->id
                ]);
            }
            return true;
        } else {
            return false;
        }
    }

    public function doClasificationOfCourses()
    {
        $connection = new MySqlConnection();
        if ($connection and $this->id > 0) {

            $pdo = $connection->getConnection();

            //$stID = $pdo->query("SELECT id FROM students WHERE persons_id = " . $this->id . ";")->fetchColumn();

            $sql = "CALL spDoCourseClassification(?)";
            $pdo->prepare($sql)->execute([
                $this->id
            ]);

            return true;
        } else {
            return false;
        }
    }

    public function getCoursesOfStudentByID()
    {
        $conn = (new MySqlConnection())->getConnection();
        $sql = "CALL spShowStudentCourses($this->id);";

        $response['courses'] = array();

        foreach ($conn->query($sql) as $row) {
            $course = array();

            $course['course'] = $row['course'];
            $course['percent'] = $row['percent'];
            $course['stat'] = $row['stat'];
            $course['num'] = $row['num'];

            array_push($response['courses'], $course);
        }
        return json_encode($response);
    }

    public function getDimensionsOfStudentByID()
    {
        $conn = (new MySqlConnection())->getConnection();
        $sql = "CALL spShowStudentDimensions($this->id);";

        $response['dimensions'] = array();

        foreach ($conn->query($sql) as $row) {
            $dim = array();

            $dim['dimension'] = $row['dimension'];
            $dim['percent'] = $row['percent'];
            $dim['stat'] = $row['stat'];
            $dim['num'] = $row['num'];

            array_push($response['dimensions'], $dim);
        }
        return json_encode($response);
    }

    public function getCoursesOfStudentByFullName($fullname)
    {
        $conn = (new MySqlConnection())->getConnection();
        $sql = "CALL spShowStudentCoursesByFullName('" . $fullname . "');";

        $response['courses'] = array();

        foreach ($conn->query($sql) as $row) {
            $course = array();

            $course['course'] = $row['course'];
            $course['percent'] = $row['percent'];
            $course['stat'] = $row['stat'];
            $course['num'] = $row['num'];

            array_push($response['courses'], $course);
        }
        return json_encode($response);
    }

    public function getDimensionsOfStudentByFullName($fullname)
    {
        $conn = (new MySqlConnection())->getConnection();
        $sql = "CALL spShowStudentDimensionsByFullName('" . $fullname . "');";

        $response['dimensions'] = array();

        foreach ($conn->query($sql) as $row) {
            $dim = array();

            $dim['dimension'] = $row['dimension'];
            $dim['percent'] = $row['percent'];
            $dim['stat'] = $row['stat'];
            $dim['num'] = $row['num'];

            array_push($response['dimensions'], $dim);
        }
        return json_encode($response);
    }

    public function getStudentsbyCourse($area, $course, $process)
    {
        //This function is used in bycourse view
        $conn = (new MySqlConnection())->getConnection();
        $sql = "CALL spShowStudentsByCourse('" . $area . "', '" . $course . "', '" . $process . "');";

        $response['students'] = array();

        foreach ($conn->query($sql) as $row) {
            $course = array();
            $course['stdID'] = $row['stdID'];
            $course['name'] = $row['name'];
            $course['lastname'] = $row['lastname'];
            $course['code'] = $row['code'];
            $course['program'] = $row['program'];
            $course['area'] = $row['area'];
            $course['process'] = $row['process'];
            $course['course'] = $row['course'];
            $course['num'] = $row['num'];
            $course['stat'] = $row['stat'];

            array_push($response['students'], $course);
        }
        return json_encode($response);
    }

    public function getStudentsbySchool($school, $process)
    {
        //This function is used in byprogram view
        $conn = (new MySqlConnection())->getConnection();
        $sql = "SELECT id, dni, name, lastname, code, omg, score, gender FROM vstudents WHERE process = '$process' and program = '$school' ORDER BY omp;";

        $response['students'] = array();

        foreach ($conn->query($sql) as $row) {
            $course = array();

            $course['id'] = $row['id'];
            $course['dni'] = $row['dni'];
            $course['name'] = $row['name'];
            $course['lastname'] = $row['lastname'];
            $course['code'] = $row['code'];
            $course['omg'] = $row['omg'];
            $course['score'] = $row['score'];
            $course['gender'] = $row['gender'];

            array_push($response['students'], $course);
        }
        return json_encode($response);
    }

    public function getDimensionForLeveling($stdtID)
    {
        $conn = (new MySqlConnection())->getConnection();
        $sql = "CALL spDimensionsForLeveling($stdtID);";

        $response['dimensions'] = array();

        foreach ($conn->query($sql) as $row) {
            $course = array();
            $course['dimension'] = $row['dimension'];
            $course['num'] = $row['num'];
            $course['stat'] = $row['stat'];

            array_push($response['dimensions'], $course);
        }
        return json_encode($response);
    }

    public function getDimensionForLevelingByFullName($fullname)
    {
        $conn = (new MySqlConnection())->getConnection();
        $sql = "CALL spDimensionsForLevelingByFullName('$fullname');";

        $response['dimensions'] = array();

        foreach ($conn->query($sql) as $row) {
            $course = array();

            $course['dimension'] = $row['dimension'];
            $course['num'] = $row['num'];
            $course['stat'] = $row['stat'];

            array_push($response['dimensions'], $course);
        }
        return json_encode($response);
    }

    public function getStudentsbyDimension($areaID, $processID)
    {
        //This function is used in bycourse view
        $conn = (new MySqlConnection())->getConnection();
        $sql = "CALL spDimensionsOfStudent(" . $areaID . ", " . $processID . ");";

        $response['students'] = array();

        foreach ($conn->query($sql) as $row) {
            $course = array();
            $course['id'] = $row['id'];//stdID
            $course['code'] = $row['code'];
            $course['score'] = $row['score'];
            $course['student'] = $row['student'];
            $course['program'] = $row['program'];
            $course['num'] = $row['num'];
            $course['stat'] = $row['stat'];

            array_push($response['students'], $course);
        }
        return json_encode($response);
    }

    public function getStudentsByArea($areaID, $processID)
    {
        //This function is used in bycourse view
        $conn = (new MySqlConnection())->getConnection();
        $sql = "SELECT 
                id, code, name, lastname, score, program, area, process, 
                if (score < (SELECT percent*4 FROM process WHERE id = $processID), 3, 1) stat, 
                if (score < (SELECT percent*4 FROM process WHERE id = $processID), 'Requiere nivelacion obligatorio', 'No requiere nivelacion') recomendation 
                FROM vstudents WHERE area = (SELECT name FROM areas WHERE id = $areaID) and 
                    process = (SELECT name FROM process WHERE id = $processID) AND 
                    score < (SELECT percent*4 FROM process WHERE id = $processID) 
                ORDER BY program ASC, lastname ASC;";

        $response['students'] = array();

        foreach ($conn->query($sql) as $row) {
            $course = array();
            $course['id'] = $row['id'];//stdID
            $course['code'] = $row['code'];
            $course['name'] = $row['name'];
            $course['lastname'] = $row['lastname'];
            $course['score'] = $row['score'];
            $course['program'] = $row['program'];
            $course['area'] = $row['area'];
            $course['process'] = $row['process'];
            $course['stat'] = $row['stat'];
            $course['recomendation'] = $row['recomendation'];
            array_push($response['students'], $course);
        }
        return json_encode($response);
    }

    public function getStudentInfoByID()
    {
        $conn = (new MySqlConnection())->getConnection();

        if (!$conn or intval($this->id) === 0) {
            return null;
        }

        $sql = "SELECT * FROM vstudents WHERE id = $this->id;";

        $result = $conn->query($sql)->fetch(PDO::FETCH_ASSOC);

        return json_encode(array(
            "id" => $result['id'],
            "stdtID" => $result['stdtID'],
            "code" => $result['code'],
            "postulant_code" => $result['postulant_code'],
            "score" => $result['score'],
            "dni" => $result['dni'],
            "name" => $result['name'],
            "lastname" => $result['lastname'],
            "gender" => $result['gender'],
            "program" => $result['program'],
            "area" => $result['area'],
            "process" => $result['process'],
            "omg" => $result['omg'],
            "omp" => $result['omp'],
            "correct" => $result['correct'],
            "incorrect" => $result['incorrect'],
            "blank" => $result['blank']
        ));
    }

    public function getStudentInfoByFullName($pattern)
    {
        $conn = (new MySqlConnection())->getConnection();
        if (!$conn) {
            return null;
        }

        $sql = "SELECT * FROM vstudents WHERE concat(lastname, ' ', name) = '" . $pattern . "';";

        $result = $conn->query($sql)->fetch(PDO::FETCH_ASSOC);
        return json_encode(array(
            "id" => $result['id'],
            "stdtID" => $result['stdtID'],
            "code" => $result['code'],
            "postulant_code" => $result['postulant_code'],
            "score" => $result['score'],
            "dni" => $result['dni'],
            "name" => $result['name'],
            "lastname" => $result['lastname'],
            "gender" => $result['gender'],
            "program" => $result['program'],
            "area" => $result['area'],
            "process" => $result['process'],
            "omg" => $result['omg'],
            "omp" => $result['omp'],
            "correct" => $result['correct'],
            "incorrect" => $result['incorrect'],
            "blank" => $result['blank']
        ));
    }

    public function getStudentsLike($pattern)
    {
        $limit = 5;
        $conn = (new MySqlConnection())->getConnection();
        $sql = "SELECT concat(lastname, ' ', name) as student FROM vstudents WHERE lastname LIKE '" . $pattern . "%' LIMIT " . $limit . ";";

        $response['students'] = array();

        foreach ($conn->query($sql) as $row) {
            $school = array();
            $school['student'] = $row['student'];
            array_push($response['students'], $school);
        }
        return json_encode($response);
    }

    /* --------------- Getters and Setters --------------- */
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    public function getDni()
    {
        return $this->dni;
    }

    public function setDni($dni)
    {
        $this->dni = $dni;
        return $this;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setQuestions($questions)
    {
        $this->questions = $questions;
        return $this;
    }

    public function getQuestions()
    {
        return $this->questions;
    }

    public function getSchool()
    {
        return $this->school;
    }

    public function setSchool($school)
    {
        $this->school = $school;
        return $this;
    }


}