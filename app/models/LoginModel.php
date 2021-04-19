<?php
//require "../database/MySqlConnection.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/nivelation/dirs.php";
include_once DB_PATH . "MySqlConnection.php";

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
        $sql = "CALL spLogin('$this->username', '$this->password');";
        return $conn->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    public function findUserByUsernameAndPassword()
    {
        $user = new UserModel();
        $conn = (new MySqlConnection())->getConnection();
        $sql = "CALL spGetUserInfoByUsernameAndPassword('$this->username', '$this->password');";
        $result = $conn->query($sql)->fetch(PDO::FETCH_ASSOC);
        $user->setId(intval($result['id']));
        $user->setDni($result['dni']);
        $user->setLastname($result['lastname']);
        $user->setName($result['name']);
        $user->setRol($result['rol']);
        $user->setUsername($result['username']);
        return $user;
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