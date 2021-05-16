<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(UTIL_PATH . "Person.php");
require_once(DB_PATH . "MySqlConnection.php");
require_once(UTIL_PATH . "Question.php");

class Student extends Person
{
    private $stda;  //stda
    private $num;  //numero en excel (primera columna)
    private $code;
    private $omg;
    private $omp;
    private $blank; // cant en respuestas en blanco
    private $good; // cant en respuestas correctas
    private $bad; // cant en respuestas incorrectas
    private $program;
    private $area;
    private $process;
    private $score;
    private $postulant_code;
    private $questions;

    /* Functions */

    public function saveStudentToDB()
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
                return $pdo->commit();
            } catch (Exception $e) {
                echo "La operación falló: " . $e->getMessage();
                return false;
            }
        } else {
            return false;
        }
    }

    public function saveQuestionsToDB()
    {
        $connection = new MySqlConnection();
        if ($connection and $this->getStda() > 0) {
            $pdo = $connection->getConnection();

            try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->beginTransaction();

                $sql_verif = "SELECT COUNT(1) FROM questions WHERE student_data_id = " . $this->getStda() . ";";

                if (intval($pdo->query($sql_verif)->fetchColumn()) < 100) {
                    $sql = "INSERT INTO questions VALUES ";
                    foreach ($this->getQuestions() as $i => $question) {

                        $sql_distID = "SELECT id FROM distributions WHERE areas_id = getAreaIDByStudentID(" . $this->getStda() . ") AND (" . $question->getNumber() . " BETWEEN dfrom AND dto);";
                        $distID = intval($pdo->query($sql_distID)->fetchColumn());

                        if ($distID > 0) {
                            $sql_verif_question = "SELECT COUNT(1) FROM questions WHERE 
                                     number = " . $question->getNumber() . " AND 
                                     student_data_id = " . $this->getStda() . " AND 
                                     responses_id = " . $question->getResponse() . " AND 
                                     distributions_id = " . $distID . ";";

                            if (intval($pdo->query($sql_verif_question)->fetchColumn()) === 0) {
                                if ($i > 0) {
                                    $sql .= ", ";
                                }
                                $sql .= "(null, " . $question->getNumber() . ", " . $this->getStda() . ", " .
                                    $question->getResponse() . ", " . $distID . ")";
                            }
                        }
                    }
                    $sql .= ";";

                    if ($sql !== "INSERT INTO questions VALUES ;") { //verificamos que la consulta tenga un valor para insertar
                        $save_question = $pdo->prepare($sql);
                        $save_question->execute(array(
                            ':num' => $question->getNumber(),
                            ':stdataID' => $this->getStda(),
                            ':rsp' => $question->getResponse()
                        ));
                        $save_question->closeCursor();
                        return $pdo->commit();
                    } else {
                        return true; //ya no hay preguntas que guardar, todo OK
                    }
                } else {
                    return true; // el estudiante ya tiene todas sus preguntas, todo OK
                }
            } catch (Exception $e) {
                $pdo->rollBack();
                echo "La operación falló: " . $e->getMessage();
                return false;
            }
        } else {
            return false;
        }
    }

    public function doClasificationOfCourses()
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
                return $pdo->commit();
            } catch (Exception $e) {
                $pdo->rollBack();
                echo "La operación falló: " . $e->getMessage();
                return false;
            }
        } else {
            return false;
        }
    }

    public function doClasificationOfDimensions()
    {
        $connection = new MySqlConnection();
        if ($connection and $this->getStda() > 0) {
            $pdo = $connection->getConnection();

            try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->beginTransaction();

                $sql = "CALL spDoDimensionClassification(:stdtID)";
                $clasify = $pdo->prepare($sql);

                $clasify->execute(array(
                    ':stdtID' => $this->getStda()
                ));
                $clasify->closeCursor();
                return $pdo->commit();
            } catch (Exception $e) {
                $pdo->rollBack();
                echo "La operación falló: " . $e->getMessage();
                return false;
            }
        } else {
            return false;
        }
    }

    /* Getters and Setters */
    public function getQuestions()
    {
        return $this->questions;
    }

    public function setQuestions($questions)
    {
        $this->questions = $questions;
        return $this;
    }

    public function getNum()
    {
        return $this->num;
    }

    public function setNum($num)
    {
        $this->num = $num;
        return $this;
    }

    public function getStda()
    {
        return $this->stda;
    }

    public function setStda($stda)
    {
        $this->stda = $stda;
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

    public function getGender()
    {
        return $this->gender;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;
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

    public function getCode()
    {
        return $this->code;
    }

    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    public function getOmg()
    {
        return $this->omg;
    }

    public function setOmg($omg)
    {
        $this->omg = $omg;
        return $this;
    }

    public function getOmp()
    {
        return $this->omp;
    }

    public function setOmp($omp)
    {
        $this->omp = $omp;
        return $this;
    }

    public function getProgram()
    {
        return $this->program;
    }

    public function setProgram($program)
    {
        $this->program = $program;
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

    public function getScore()
    {
        return $this->score;
    }

    public function setScore($score)
    {
        $this->score = $score;
        return $this;
    }

    public function getPostulantCode()
    {
        return $this->postulant_code;
    }

    public function setPostulantCode($postulant_code)
    {
        $this->postulant_code = $postulant_code;
        return $this;
    }

    public function getBlank()
    {
        return $this->blank;
    }

    public function setBlank($blank)
    {
        $this->blank = $blank;
        return $this;
    }

    public function getGood()
    {
        return $this->good;
    }

    public function setGood($good)
    {
        $this->good = $good;
        return $this;
    }

    public function getBad()
    {
        return $this->bad;
    }

    public function setBad($bad)
    {
        $this->bad = $bad;
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

}