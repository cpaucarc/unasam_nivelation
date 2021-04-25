<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/nivelation/dirs.php";
include_once DB_PATH . "MySqlConnection.php";
include_once MODEL_PATH . "LoginModel.php";

$username = '181.0001.001';
$password = '03234567';
$rol = 1;

$login = new LoginModel();
$login->setUsername($username);
$login->setPassword($password);
$login->setRol($rol);
$response = ($login->login());
//if ($response['status'] == "1") {
//    session_start();
//
//    $user = $login->findUserByUsernameAndPassword();
//
//    $_SESSION['user_logged'] = array();
//    $_SESSION['user_logged']['id'] = $user->getId();
//    $_SESSION['user_logged']['username'] = $user->getUsername();
//    $_SESSION['user_logged']['dni'] = $user->getDni();
//    $_SESSION['user_logged']['lastname'] = $user->getLastname();
//    $_SESSION['user_logged']['name'] = $user->getName();
//    $_SESSION['user_logged']['rol'] = $user->getRol();
//}
var_dump($response);
echo json_encode($response);
