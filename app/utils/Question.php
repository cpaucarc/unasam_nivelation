<?php


class Question
{
    private $number; // int
    private $response; // float: 0: blanco, 4: correcto, -0.5 incorrecto

    public function __construct($number, $response)
    {
        $this->number = $number;
        $this->response = $response;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    public function getResponse()
    {
        if ($this->response > 0) { // response = 4.0
            return 1; //Correcto
        } elseif ($this->response < 0) { // response = -0.5
            return 2; //Incorrecto
        } else { // response = 0
            return 3;//Blanco
        }
    }

    public function setResponse($response)
    {
        $this->response = $response;
        return $this;
    }
}