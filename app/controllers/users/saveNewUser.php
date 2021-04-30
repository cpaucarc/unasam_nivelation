<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(MODEL_PATH . "UserModel.php");
require_once(UTIL_PATH . "SendMessage.php");

$name = $_POST['user_name'];
$lastname = $_POST['user_lastname'];
$dni = $_POST['user_dni'];
$rol = $_POST['user_rol'];
$username = $_POST['user_username'];
$password = $_POST['user_password'];
$genderID = intval($_POST['gender']);

$message = 'Error, datos incompletos: ';
$finalMessage = '';

try {
    if (verifyDataComplete($name, $lastname, $dni, $rol, $username, $password, $finalMessage)) {
        if ($genderID > 0) {

            $user = new UserModel();
            $user->setName($name);
            $user->setLastname($lastname);
            $user->setDni($dni);
            $user->setRol($rol);
            $user->setUsername($username);
            $user->setPassword($password);
            $user->setGenderID($genderID);

            if (!$user->dniIsAlreadyRegistered()) {
                echo (new SendMessage("Este DNI ya se encuentra registrado", false))->getEncodedMessage();
            } else {
                if (!$user->usernameIsAlreadyInUse()) {
                    echo (new SendMessage("Este nombre de usuario ya se encuentra en uso, escoja otro", false))->getEncodedMessage();
                } else {
                    if ($user->saveNewUser()) {
                        echo (new SendMessage("Se registro con exito al usuario.", true))->getEncodedMessage();
                    } else {
                        echo (new SendMessage("Hubo problemas al registrar al usuario.", false))->getEncodedMessage();
                    }
                }
            }
        } else {
            echo (new SendMessage("Falta seleccionar un genero.", false))->getEncodedMessage();
        }
    } else {
        echo (new SendMessage($message . $finalMessage, false))->getEncodedMessage();
    }
} catch (Exception $e) {
    echo (new SendMessage("Error " . $e, false))->getEncodedMessage();
}

function verifyDataComplete($name, $lastname, $dni, $rol, $username, $password, $msg)
{
    if (isset($dni) and strlen($dni) === 8) {
        if (isset($name)) {
            if (isset($lastname)) {
                if (isset($rol)) {
                    if (isset($username)) {
                        if (isset($password)) {
                            return true;
                        } else {
                            $msg = 'Faltan la contraseña';
                            return false;
                        }
                    } else {
                        $msg = 'Faltan el nombre de usuario';
                        return false;
                    }
                } else {
                    $msg = 'Faltan el rol desl usuario';
                    return false;
                }
            } else {
                $msg = 'Faltan los apellidos';
                return false;
            }
        } else {
            $msg = 'Faltan los nombres';
            return false;
        }
    } else {
        $msg = 'Formato de DNI erroneo';
        return false;
    }
}
