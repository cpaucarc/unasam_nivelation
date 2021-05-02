<?php


class Question
{
    private int $number;
    private float $response;

    public function __construct($number, $response)
    {
        $this->number = $number;
        $this->response = $response;
    }

    /**
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * @param int $number
     * @return Question
     */
    public function setNumber(int $number): Question
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @return float
     */
    public function getResponse(): float
    {
        return $this->response;
    }

    /**
     * @param float $response
     * @return Question
     */
    public function setResponse(float $response): Question
    {
        $this->response = $response;
        return $this;
    }

    /* ----------- Getters ----------- */


}