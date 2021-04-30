<?php
//require "../database/MySqlConnection.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/nivelation/dirs.php";
include_once DB_PATH . "MySqlConnection.php";

class LoginModel
{
    private string $username;
    private string $password;
    private int $rol; // user_type:ID

    public function __construct()
    {
    }

    public function login()
    {
        $conn = (new MySqlConnection())->getConnection();
        $sql = "CALL spLogin('$this->username', '$this->password', $this->rol);";
        return $conn->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    public function findUserByUsernameAndPassword()
    {
        $user = new UserModel();
        $conn = (new MySqlConnection())->getConnection();
        $sql = "CALL spGetUserLoggedInfo('$this->username', '$this->password', $this->rol);";
        $result = $conn->query($sql)->fetch(PDO::FETCH_ASSOC);
        $user->setId(intval($result['id']));
        $user->setDni($result['dni']);
        $user->setLastname($result['lastname']);
        $user->setName($result['name']);
        $user->setRolID($result['utid']);
        $user->setRol($result['rol']);
        $user->setUsername($result['username']);
        $user->setGender($result['gender']);
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

    /**
     * @return mixed
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * @param mixed $rol
     * @return LoginModel
     */
    public function setRol($rol)
    {
        $this->rol = $rol;
        return $this;
    }

}