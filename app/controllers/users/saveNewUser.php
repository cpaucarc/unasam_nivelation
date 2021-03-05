<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(MODEL_PATH . "UserModel.php");

$name = $_POST['user_name'];
$lastname = $_POST['user_lastname'];
$dni = $_POST['user_dni'];
$rol = $_POST['user_rol'];
$username = $_POST['user_username'];
$password = $_POST['user_password'];

$user = new UserModel();
$user->setName($name);
$user->setLastname($lastname);
$user->setDni($dni);
$user->setRol($rol);
$user->setUsername($username);
$user->setPassword($password);

if ($user->saveNewUser()) {
    echo sendResponse("Se registro con exito al usuario", true);
} else {
    echo sendResponse("No se puedo resgistrar al usuario", false);
}

function sendResponse($response, $status)
{
    $rsp = array(
        "message" => $response,
        "status" => $status
    );
    return json_encode($rsp);
}