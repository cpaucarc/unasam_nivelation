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

try {
    if (verifyDataComplete()) {

        $user = new UserModel();
        $user->setName($name);
        $user->setLastname($lastname);
        $user->setDni($dni);
        $user->setRol($rol);
        $user->setUsername($username);
        $user->setPassword($password);

        if ($user->saveNewUser()) {
            echo (new SendMessage("Se registro con exito al usuario.", true))->getEncodedMessage();
        } else {
            echo (new SendMessage("Hubo problemas al registrar al usuario.", false))->getEncodedMessage();
        }
    } else {
        echo (new SendMessage("Error, datos incompletos.", false))->getEncodedMessage();
    }
} catch (Exception $e) {
    echo (new SendMessage("Error " . $e, false))->getEncodedMessage();
}

function verifyDataComplete()
{
    return isset($name) and isset($lastname) and isset($dni) and isset($rol) and isset($username) and isset($password);
}