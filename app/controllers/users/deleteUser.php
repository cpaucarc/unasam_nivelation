<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(MODEL_PATH . "UserModel.php");
require_once(UTIL_PATH . "SendMessage.php");

try {
    $userID = intval($_POST['userID']);

    if (isset($userID) and $userID > 0) {

        $user = new UserModel();
        $user->setId($userID);

        if ($user->deleteUser()) {
            echo (new SendMessage("Se elimino con exito al usuario", true))->getEncodedMessage();
        } else {
            echo (new SendMessage("Hubo problemas al eliminar al usuario", false))->getEncodedMessage();
        }
    } else {
        echo (new SendMessage("Error, no se especificó el usuario", false))->getEncodedMessage();
    }
} catch (Exception $e) {
    echo (new SendMessage("Error " . $e, false))->getEncodedMessage();
}