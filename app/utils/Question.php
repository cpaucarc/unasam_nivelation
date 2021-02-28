<?php


class Question
{
    private $number;
    private $response;
    private $course;

    public function __construct($number, $response, $course)
    {
        $this->number = $number;
        $this->response = $response;
        $this->course = $course;
    }

    /* ----------- Getters ----------- */
    public function getNumber()
    {
        return $this->number;
    }

    public function getResponse()
    {
        if ($this->response == TRUE) {
            return 1;
        } elseif ($this->response == FALSE) {
            return 0;
        }
    }

    public function getCourse()
    {
        return $this->course;
    }


}