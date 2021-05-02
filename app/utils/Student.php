<?php


class Student extends Person
{
    private int $stda;  //stda
    private string $code;
    private int $omg;
    private int $omp;
    private string $program;
    private string $process;
    private float $score;
    private string $postulant_code;
    private array $questions;

    /**
     * @return array
     */
    public function getQuestions(): array
    {
        return $this->questions;
    }

    /**
     * @param array $questions
     * @return Student
     */
    public function setQuestions(array $questions): Student
    {
        $this->questions = $questions;
        return $this;
    }

    /**
     * @return int
     */
    public function getStda(): int
    {
        return $this->stda;
    }

    /**
     * @param int $stda
     * @return Student
     */
    public function setStda(int $stda): Student
    {
        $this->stda = $stda;
        return $this;
    }

    /**
     * @return string
     */
    public function getDni(): string
    {
        return $this->dni;
    }

    /**
     * @param string $dni
     * @return Student
     */
    public function setDni(string $dni): Student
    {
        $this->dni = $dni;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Student
     */
    public function setName(string $name): Student
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     * @return Student
     */
    public function setLastname(string $lastname): Student
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     * @return Student
     */
    public function setGender(string $gender): Student
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Student
     */
    public function setId(int $id): Student
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return Student
     */
    public function setCode(string $code): Student
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return int
     */
    public function getOmg(): int
    {
        return $this->omg;
    }

    /**
     * @param int $omg
     * @return Student
     */
    public function setOmg(int $omg): Student
    {
        $this->omg = $omg;
        return $this;
    }

    /**
     * @return int
     */
    public function getOmp(): int
    {
        return $this->omp;
    }

    /**
     * @param int $omp
     * @return Student
     */
    public function setOmp(int $omp): Student
    {
        $this->omp = $omp;
        return $this;
    }

    /**
     * @return string
     */
    public function getProgram(): string
    {
        return $this->program;
    }

    /**
     * @param string $program
     * @return Student
     */
    public function setProgram(string $program): Student
    {
        $this->program = $program;
        return $this;
    }

    /**
     * @return string
     */
    public function getProcess(): string
    {
        return $this->process;
    }

    /**
     * @param string $process
     * @return Student
     */
    public function setProcess(string $process): Student
    {
        $this->process = $process;
        return $this;
    }

    /**
     * @return float
     */
    public function getScore(): float
    {
        return $this->score;
    }

    /**
     * @param float $score
     * @return Student
     */
    public function setScore(float $score): Student
    {
        $this->score = $score;
        return $this;
    }

    /**
     * @return string
     */
    public function getPostulantCode(): string
    {
        return $this->postulant_code;
    }

    /**
     * @param string $postulant_code
     * @return Student
     */
    public function setPostulantCode(string $postulant_code): Student
    {
        $this->postulant_code = $postulant_code;
        return $this;
    }


}