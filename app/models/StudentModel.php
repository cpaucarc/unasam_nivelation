<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/ogcu/dirs.php');
require_once(DB_PATH . "MySqlConnection.php");
require_once(UTIL_PATH . "Question.php");

class StudentModel
{
    private string $name;
    private string $lastname;
    private string $dni;
    private string $code;
    private string $school;
    private int $id; // This is StudentID, not PersonID
    private array $questions;

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

    public function getStudentsbyCourse($area, $course, $process)
    {
        //This function is used in bycourse view
        $conn = (new MySqlConnection())->getConnection();
        $sql = "CALL spShowStudentsByCourse('" . $area . "', '" . $course . "', '" . $process . "');";

        $response['students'] = array();

        foreach ($conn->query($sql) as $row) {
            $course = array();
//stdID, dni, name, lastname, code, program, area, process, course, num, stat, id
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

    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    public function getDni()
    {
        return $this->dni;
    }

    public function setDni(string $dni)
    {
        $this->dni = $dni;
        return $this;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setCode(string $code)
    {
        $this->code = $code;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    public function setQuestions(array $questions)
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