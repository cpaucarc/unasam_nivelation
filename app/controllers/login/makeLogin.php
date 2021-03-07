<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(MODEL_PATH . "LoginModel.php");

$username = $_POST['username'];
$password = $_POST['password'];

$login = new LoginModel();
$login->setUsername($username);
$login->setPassword($password);
echo($login->login());

