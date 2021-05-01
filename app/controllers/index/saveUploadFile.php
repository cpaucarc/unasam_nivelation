<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(MODEL_PATH . "FileModel.php");
require_once(UTIL_PATH . "SendMessage.php");


if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $name = $file['name'];
    $size = $file['size'];
    $type = $file['type'];
    $temporal = $file['tmp_name'];

    session_start();

    if ($type == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
        $fileModel = new FileModel();
        $fileModel->setName($name);
        $fileModel->setSize($size);
        $fileModel->setType($type);
        $fileModel->setTemporalDir($temporal);

        $rsp = $fileModel->moveFileToFinalDir();

        if ($rsp) {
            $_SESSION['files']['tmppath'] = $temporal;
            $_SESSION['files']['filepath'] = $fileModel->getPath();
            echo (new SendMessage($fileModel->getPath() . ' - ' . $temporal, true))->getEncodedMessage();
        } else {
            $_SESSION['files']['tmppath'] = '';
            $_SESSION['files']['filepath'] = "";
            echo (new SendMessage('Error, el archivo no fue guardado', false))->getEncodedMessage();
        }
    } else {
        $_SESSION['files']['tmppath'] = '';
        $_SESSION['files']['filepath'] = "";
        echo (new SendMessage('Error, el archivo debe ser un Excel', false))->getEncodedMessage();
    }
}