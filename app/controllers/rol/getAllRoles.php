<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(MODEL_PATH . "RolModel.php");
require_once(UTIL_PATH . "SendMessage.php");

try {
    $rol = new RolModel();
    echo($rol->getAllRoles());
} catch (Exception $e) {
    echo (new SendMessage("Hubo problemas al obtener los roles " . $e, false))->getEncodedMessage();
}