<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(MODEL_PATH . "UserModel.php");

$userID = $_POST['userID'];

if (isset($userID)) {

    $user = new UserModel();
    $user->setId($userID);

    if ($user->deleteUser()) {
        echo sendResponse("Se elimino con exito al usuario", true);
    } else {
        echo sendResponse("Hubo problemas al eliminar al usuario", false);
    }
} else {
    echo sendResponse("Error, no se especifico el usuario", false);
}


function sendResponse($response, $status)
{
    $rsp = array(
        "message" => $response,
        "status" => $status
    );
    return json_encode($rsp);
}