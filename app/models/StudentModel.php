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

            $id_value = $pdo->query("SELECT getStudentID('$this->dni');");
            $this->setId(intval($id_value->fetchColumn()));
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
                    $question->getCourse(),
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

            $sql = "CALL spDoCourseClasify(?)";
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
        $sql = "CALL spShowStudentCurses($this->id);";

        $response['courses'] = array();

        foreach ($conn->query($sql) as $row) {
            $course = array();

            $course['course'] = $row['course'];
            $course['percent'] = $row['percent'];
            $course['stat'] = $row['stat'];

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

    public function getStudentInfo()
    {
        $conn = (new MySqlConnection())->getConnection();
        $sql = "SELECT * FROM vstudents WHERE id = $this->id;";

        $result = $conn->query($sql)->fetch(PDO::FETCH_ASSOC);

        $this->setCode($result['code']);
        $this->setDni($result['dni']);
        $this->setName($result['name']);
        $this->setLastname($result['lastname']);
        $this->setSchool($result['school']);

        return $this;
    }

    public function getStudentInfoByFullName($pattern)
    {
        $conn = (new MySqlConnection())->getConnection();
        $sql = "SELECT * FROM vstudents WHERE concat(lastname, ' ', name) = '" . $pattern . "';";

        $result = $conn->query($sql)->fetch(PDO::FETCH_ASSOC);

        return json_encode(array(
            "code" => $result['code'],
            "dni" => $result['dni'],
            "name" => $result['name'],
            "lastname" => $result['lastname'],
            "school" => $result['school'],
            "process" => $result['process']
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