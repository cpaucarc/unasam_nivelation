<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(MODEL_PATH . "UserModel.php");
require_once(UTIL_PATH . "SendMessage.php");

try {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $repeat = $_POST['repeat'];
    $id = intval($_POST['id']);

    if (isset($username) and isset($password) and isset($repeat) and isset($id) and $id > 0) {

        if (strcmp($password, $repeat) === 0) {
            $userModel = new UserModel();
            $userModel->setId($id);
            $userModel->setUsername($username);
            $userModel->setPassword($password);

            $rsp = $userModel->updateAccessInfo();

            if ($rsp) {
                $_SESSION['user_logged']['username'] = $username;
                echo (new SendMessage("Los datos de acceso se actualizaron con exito", true))->getEncodedMessage();
            } else {
                echo (new SendMessage("Hubo un error al actualizar los datos de acceso", false))->getEncodedMessage();
            }
        } else {
            echo (new SendMessage("Las contraseñas deben ser iguales", false))->getEncodedMessage();
        }
    } else {
        echo (new SendMessage("Faltan datos ", false))->getEncodedMessage();
    }
} catch (Exception $e) {
    echo (new SendMessage("Error " . $e->getMessage(), false))->getEncodedMessage();
}
