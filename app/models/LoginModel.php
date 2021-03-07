<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(DB_PATH . "MySqlConnection.php");


class LoginModel
{
    private $username;
    private $password;

    public function __construct()
    {
    }

    public function login()
    {
        $conn = (new MySqlConnection())->getConnection();
        $sql = "CALL spLogin(?, ?);";
        $result = $conn->prepare($sql)->execute([
            $this->username,
            $this->password
        ])->fetch(PDO::FETCH_ASSOC);

        return json_encode($result);
    }


    /* ---------- Getters & Setters ---------- */
    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }


}