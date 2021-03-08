<?php


class SendMessage
{
    private $message;
    private $status;

    public function __construct($message, $status)
    {
        $this->setMessage($message);
        $this->setStatus($status);
    }

    public function getEncodedMessage()
    {
        $rsp = array(
            "message" => $this->message,
            "status" => $this->status
        );
        return json_encode($rsp);
    }

    public function setMessage($message): void
    {
        $this->message = $message;
    }

    public function setStatus($status): void
    {
        if (!is_bool($status)) {
            if (is_int($status)) {
                $status = $status === 1;
            } else if (is_string($status)) {
                $status = intval($status);
                $status = $status === 1;
            } else {
                $status = false;
            }
        }
        $this->status = $status;
    }
}