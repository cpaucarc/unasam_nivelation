<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/ogcu/dirs.php');
require_once(MODEL_PATH . "UserModel.php");
require_once(UTIL_PATH . "SendMessage.php");

try {
    $rol = $_POST['user_rol'];
    $userID = $_POST['id_user'];

    if (isset($rol) and isset($userID)) {
        $user = new UserModel();
        $user->setId($userID);
        $response = $user->updateRol($rol);
        if ($response) {
            echo (new SendMessage("Se actualizó con éxito el rol del usuario", true))->getEncodedMessage();
        } else {
            echo (new SendMessage("Hubo problemas al actualizar el rol", false))->getEncodedMessage();
        }
    } else {
        echo (new SendMessage("¡Faltan datos!", false))->getEncodedMessage();
    }
} catch (Exception $e) {
    echo (new SendMessage("Hubo problemas al obtener los usuarios " . $e, false))->getEncodedMessage();
}