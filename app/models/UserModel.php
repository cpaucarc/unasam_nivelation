<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(DB_PATH . "MySqlConnection.php");

class UserModel
{
    private $id;
    private $username;
    private $password;
    private $rolID;
    private $rol;
    private $dni;
    private $name;
    private $lastname;
    private $gender;
    private $genderID;

    public function __construct()
    {
    }

    public function saveNewUser()
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "CALL createNewUser(?, ?, ?, ?, ?, ?, ?);";
            $pdo->prepare($sql)->execute([
                $this->username,
                $this->password,
                $this->name,
                $this->lastname,
                $this->dni,
                $this->rol,
                $this->genderID
            ]);
            return true;
        } else {
            return false;
        }
    }

    public function updateRol($rol)
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "UPDATE users SET user_type_id = (SELECT id FROM user_type WHERE type = ?) WHERE id = ?;";
            $pdo->prepare($sql)->execute([
                $rol,
                $this->id
            ]);
            return true;
        } else {
            return false;
        }
    }

    public function updatePersonalInfo()
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "CALL spUpdatePersonPersonalInfo('$this->name', '$this->lastname', '$this->dni', $this->id, $this->genderID);";
            $response = intval($pdo->query($sql)->fetchColumn());
            return $response == 1; // 1:true, 0:false
        } else {
            return false;
        }
    }

    public function updateAccessInfo()
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "UPDATE users SET username = ?, password = sha1(?) WHERE id = ?;";
            $pdo->prepare($sql)->execute([
                $this->username,
                $this->password,
                $this->id
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

    public function usernameIsAlreadyInUse()
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "SELECT count(1) as num FROM users WHERE username = '" . $this->username . "'";
            $num = $pdo->query($sql)->fetchColumn();
            $num = intval($num);
            if ($num === 0) {
                return true;// The username not is used
            } else {
                return false; // The username is already used
            }
        } else {
            return false;
        }
    }

    public function dniIsAlreadyRegistered()
    {
        $connection = new MySqlConnection();
        if ($connection) {
            $pdo = $connection->getConnection();
            $sql = "SELECT count(1) as num FROM people WHERE dni = '" . $this->dni . "'";
            $num = $pdo->query($sql)->fetchColumn();
            $num = intval($num);
            if ($num === 0) {
                return true;// The DNI not is registered
            } else {
                return false; // The DNI is registered
            }
        } else {
            return false;
        }
    }

    public function getAllUsers()
    {
        $conn = (new MySqlConnection())->getConnection();
        $sql = "SELECT * FROM vusers ORDER BY rol, lastname;";

        $response['users'] = array();
        foreach ($conn->query($sql) as $row) {
            $user = array();
            $user['id'] = $row['id'];
            $user['dni'] = $row['dni'];
            $user['lastname'] = $row['lastname'];
            $user['gender'] = $row['gender'];
            $user['name'] = $row['name'];
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

    /**
     * @return mixed
     */
    public function getRolID()
    {
        return $this->rolID;
    }

    /**
     * @param mixed $rolID
     * @return UserModel
     */
    public function setRolID($rolID)
    {
        $this->rolID = $rolID;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGenderID()
    {
        return $this->genderID;
    }

    /**
     * @param mixed $genderID
     * @return UserModel
     */
    public function setGenderID($genderID)
    {
        $this->genderID = $genderID;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     * @return UserModel
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
        return $this;
    }
}