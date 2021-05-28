<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/nivelation/dirs.php";
include_once MODEL_PATH . "LoginModel.php";
include_once MODEL_PATH . "UserModel.php";
include_once UTIL_PATH . "SendMessage.php";

try {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $login = new LoginModel();
    $login->setUsername($username);
    $login->setPassword($password);
    $response = ($login->login());


    session_start();

    if ($response['status'] == "1") {
        $user = $login->findUserByUsernameAndPassword();
        $_SESSION['user_logged'] = array();
        $_SESSION['user_logged']['id'] = $user->getId();
        $_SESSION['user_logged']['dni'] = $user->getDni();
        $_SESSION['user_logged']['lastname'] = $user->getLastname();
        $_SESSION['user_logged']['name'] = $user->getName();
        $_SESSION['user_logged']['gender'] = $user->getGender();
        $_SESSION['user_logged']['utid'] = $user->getRolID();//UserType
        $_SESSION['user_logged']['rol'] = $user->getRol();
        $_SESSION['user_logged']['username'] = $user->getUsername();

        try {
            unset($_SESSION['login']);
        } catch (Exception $e) {
        }

        if (intval($_SESSION['user_logged']['utid']) === 1) { //Administrador
            header("Location: " . PROJECT . "inicio", TRUE, 301);
            exit;
        } elseif (intval($_SESSION['user_logged']['utid']) === 2) { //Visor de Recursos
            header("Location: " . PROJECT . "programas", TRUE, 301);
            exit;
        } elseif (intval($_SESSION['user_logged']['utid']) === 3) { //Estudiante
            header("Location: " . PROJECT . "estudiante/" . $_SESSION['user_logged']['id'], TRUE, 301);
            exit;
        } elseif (intval($_SESSION['user_logged']['utid']) === 4) { //Docente
            header("Location: " . PROJECT . "mis-cursos", TRUE, 301);
            exit;
        } elseif (intval($_SESSION['user_logged']['utid']) === 5) { //Director
            header("Location: " . PROJECT . "seguimiento", TRUE, 301);
            exit;
        }

    } else {
        $_SESSION['login'] = array();
        $_SESSION['login']['error'] = $response['response'];
        $_SESSION['login']['user'] = $username;
        header("Location: " . PROJECT . "login", TRUE, 301);
        exit;
    }

//    echo json_encode($response);
} catch (Exception $e) {
    echo (new SendMessage("Error " . $e->getMessage(), false))->getEncodedMessage();
}