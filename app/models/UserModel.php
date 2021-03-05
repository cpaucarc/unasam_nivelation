<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(DB_PATH . "MySqlConnection.php");

class UserModel
{
    private $id;
    private $username;
    private $password;
    private $rol;
    private $dni;
    private $name;
    private $lastname;

    public function __construct()
    {
    }

    public function saveNewUser()
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "CALL createNewUser(?, ?, ?, ?, ?, ?);";
            $pdo->prepare($sql)->execute([
                $this->username,
                $this->password,
                $this->name,
                $this->lastname,
                $this->dni,
                $this->rol
            ]);
            return true;
        } else {
            return false;
        }
    }

    public function deleteUser()
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "DELETE FROM users WHERE id = ?;";
            $pdo->prepare($sql)->execute([
                $this->id
            ]);
            return true;
        } else {
            return false;
        }
    }

    public function getAllUsers()
    {
        $conn = (new MySqlConnection())->getConnection();
        $sql = "SELECT * FROM vusers ORDER BY person;";

        $response['users'] = array();
        foreach ($conn->query($sql) as $row) {
            $user = array();
            $user['id'] = $row['id'];
            $user['dni'] = $row['dni'];
            $user['person'] = $row['person'];
            $user['rol'] = $row['rol'];
            $user['username'] = $row['username'];
            array_push($response['users'], $user);
        }
        return json_encode($response);
    }

    /* ---------- Getters and Setters ---------- */
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

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

    public function getRol()
    {
        return $this->rol;
    }

    public function setRol($rol)
    {
        $this->rol = $rol;
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


}