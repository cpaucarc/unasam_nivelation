<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(MODEL_PATH . "LoginModel.php");
require_once(MODEL_PATH . "UserModel.php");

$username = $_POST['username'];
$password = $_POST['password'];

$login = new LoginModel();
$login->setUsername($username);
$login->setPassword($password);
$response = ($login->login());

if ($response['status'] == "1") {
    session_start();

    $user = $login->findUserByUsernameAndPassword();

    $_SESSION['user_logged'] = array();
    $_SESSION['user_logged']['id'] = $user->getId();
    $_SESSION['user_logged']['username'] = $user->getUsername();
    $_SESSION['user_logged']['dni'] = $user->getDni();
    $_SESSION['user_logged']['lastname'] = $user->getLastname();
    $_SESSION['user_logged']['name'] = $user->getName();
    $_SESSION['user_logged']['rol'] = $user->getRol();

    echo json_encode($response);
} else {
    echo json_encode($response);
}





