<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/ogcu/dirs.php');
require_once(MODEL_PATH . "UserModel.php");
require_once(UTIL_PATH . "SendMessage.php");

try {
    $user = new UserModel();
    echo($user->getAllUsers());
} catch (Exception $e) {
    echo (new SendMessage("Hubo problemas al obtener los usuarios " . $e, false))->getEncodedMessage();
}