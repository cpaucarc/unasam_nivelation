<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(MODEL_PATH . "UserModel.php");
require_once(UTIL_PATH . "SendMessage.php");
session_start();

try {

    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $dni = $_POST['dni'];
    $id = intval($_POST['id']);

    if (isset($name) and isset($lastname) and isset($dni) and isset($id) and $id > 0) {
        $userModel = new UserModel();
        $userModel->setId($id);
        $userModel->setLastname($lastname);
        $userModel->setName($name);
        $userModel->setDni($dni);

        $rsp = $userModel->updatePersonalInfo();

        if ($rsp) {
            $_SESSION['user_logged']['dni'] = $dni;
            $_SESSION['user_logged']['lastname'] = $lastname;
            $_SESSION['user_logged']['name'] = $name;
            echo (new SendMessage("Los datos se actualizaron con exito", true))->getEncodedMessage();
        } else {
            echo (new SendMessage("Hubo un error al actualizar los datos", false))->getEncodedMessage();
        }
    } else {
        echo (new SendMessage("Faltan datos ", false))->getEncodedMessage();
    }
} catch (Exception $e) {
    echo (new SendMessage("Error " . $e->getMessage(), false))->getEncodedMessage();
}
