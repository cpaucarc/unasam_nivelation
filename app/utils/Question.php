<?php


class Question
{
    private $number;
    private $response;

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
        return $this->response;
    }

    public function setResponse($response)
    {
        $this->response = $response;
        return $this;
    }
}