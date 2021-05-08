<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(UTIL_PATH . "Person.php");
require_once(DB_PATH . "MySqlConnection.php");
require_once(UTIL_PATH . "Question.php");

class Student extends Person
{
    private int $stda;  //stda
    private int $num;  //numero en excel (primera columna)
    private string $code;
    private int $omg;
    private int $omp;
    private int $blank; // cant en respuestas en blanco
    private int $good; // cant en respuestas correctas
    private int $bad; // cant en respuestas incorrectas
    private string $program;
    private string $area;
    private string $process;
    private float $score;
    private string $postulant_code;
    private array $questions;

    /* Functions */

    public function saveStudentToDB(): void
    {
        $connection = new MySqlConnection();
        if ($connection and $this->getStda() == 0) {
            $pdo = $connection->getConnection();
            try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->beginTransaction();

                $sql = "CALL spSaveStudent(:dni, :name, :lastname, :gender, :code, :omg, :score, :postulantcode, :good, :bad, :blank, :program)";
                $ex = $pdo->prepare($sql);
                $ex->execute(array(
                    ':dni' => $this->getDni(),
                    ':name' => $this->getName(),
                    ':lastname' => $this->getLastname(),
                    ':gender' => $this->getGender(),
                    ':code' => $this->getCode(),
                    ':omg' => $this->getOmg(),
                    ':score' => $this->getScore(),
                    ':postulantcode' => $this->getPostulantCode(),
                    ':good' => $this->getGood(),
                    ':bad' => $this->getBad(),
                    ':blank' => $this->getBlank(),
                    ':program' => $this->getProgram()
                ));

                $stdataID = intval($ex->fetchColumn()) ?? 0;
                $this->setStda($stdataID);
                $ex->closeCursor();
                $pdo->commit();
            } catch (Exception $e) {
                echo "La operación falló: " . $e->getMessage();
            }
        }
    }

    public function saveQuestionsToDB(): void
    {
        $connection = new MySqlConnection();
        if ($connection and $this->getStda() > 0) {
            $pdo = $connection->getConnection();

            try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->beginTransaction();

                $sql = "CALL spSaveQuestionsByStudent(:num, :stdataID, :rsp);";
                $save_question = $pdo->prepare($sql);

                foreach ($this->getQuestions() as $question) {
                    $save_question->execute(array(
                        ':num' => $question->getNumber(),
                        ':stdataID' => $this->getStda(),
                        ':rsp' => $question->getResponse()
                    ));
                    $save_question->closeCursor();
                }
                $pdo->commit();
            } catch (Exception $e) {
                $pdo->rollBack();
                echo "La operación falló: " . $e->getMessage();
            }
        }
    }

    public function doClasificationOfCourses(): void
    {
        $connection = new MySqlConnection();
        if ($connection and $this->getStda() > 0) {
            $pdo = $connection->getConnection();

            try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->beginTransaction();

                $sql = "CALL spDoCourseClassification(:stdtID)";
                $clasify = $pdo->prepare($sql);

                $clasify->execute(array(
                    ':stdtID' => $this->getStda()
                ));
                $clasify->closeCursor();
                $pdo->commit();
            } catch (Exception $e) {
                $pdo->rollBack();
                echo "La operación falló: " . $e->getMessage();
            }
        }
    }

    /* Getters and Setters */
    public function getQuestions(): array
    {
        return $this->questions;
    }

    public function setQuestions(array $questions): Student
    {
        $this->questions = $questions;
        return $this;
    }

    public function getNum(): int
    {
        return $this->num;
    }

    public function setNum(int $num): Student
    {
        $this->num = $num;
        return $this;
    }

    public function getStda(): int
    {
        return $this->stda;
    }

    public function setStda(int $stda): Student
    {
        $this->stda = $stda;
        return $this;
    }

    public function getDni(): string
    {
        return $this->dni;
    }

    public function setDni(string $dni): Student
    {
        $this->dni = $dni;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Student
    {
        $this->name = $name;
        return $this;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): Student
    {
        $this->lastname = $lastname;
        return $this;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function setGender(string $gender): Student
    {
        $this->gender = $gender;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Student
    {
        $this->id = $id;
        return $this;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): Student
    {
        $this->code = $code;
        return $this;
    }

    public function getOmg(): int
    {
        return $this->omg;
    }

    public function setOmg(int $omg): Student
    {
        $this->omg = $omg;
        return $this;
    }

    public function getOmp(): int
    {
        return $this->omp;
    }

    public function setOmp(int $omp): Student
    {
        $this->omp = $omp;
        return $this;
    }

    public function getProgram(): string
    {
        return $this->program;
    }

    public function setProgram(string $program): Student
    {
        $this->program = $program;
        return $this;
    }

    public function getProcess(): string
    {
        return $this->process;
    }

    public function setProcess(string $process): Student
    {
        $this->process = $process;
        return $this;
    }

    public function getScore(): float
    {
        return $this->score;
    }

    public function setScore(float $score): Student
    {
        $this->score = $score;
        return $this;
    }

    public function getPostulantCode(): string
    {
        return $this->postulant_code;
    }

    public function setPostulantCode(string $postulant_code): Student
    {
        $this->postulant_code = $postulant_code;
        return $this;
    }

    public function getBlank(): int
    {
        return $this->blank;
    }

    public function setBlank(int $blank): Student
    {
        $this->blank = $blank;
        return $this;
    }

    public function getGood(): int
    {
        return $this->good;
    }

    public function setGood(int $good): Student
    {
        $this->good = $good;
        return $this;
    }

    public function getBad(): int
    {
        return $this->bad;
    }

    public function setBad(int $bad): Student
    {
        $this->bad = $bad;
        return $this;
    }

    public function getArea(): string
    {
        return $this->area;
    }

    public function setArea(string $area): Student
    {
        $this->area = $area;
        return $this;
    }

}