<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(UTIL_PATH . "SendMessage.php");

if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $name = $file['name'];
    $size = $file['size'];
    $type = $file['type'];
    $temporal = $file['tmp_name'];

    session_start();

    if ($type == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
        require_once(MODEL_PATH . "FileModel.php");

        $fileModel = new FileModel();
        $fileModel->setName($name);
        $fileModel->setSize($size);
        $fileModel->setType($type);
        $fileModel->setTemporalDir($temporal);

        $rsp = $fileModel->moveFileToFinalDir();

        if ($rsp) {
            require_once(UTIL_PATH . "ExcelReader.php");

            $_SESSION['files']['tmppath'] = $temporal;
            $_SESSION['files']['filepath'] = $fileModel->getPath();
            $excelReader = new ExcelReader($fileModel->getPath());
            $_SESSION['files']['students'] = $excelReader->read();
            echo (new SendMessage($fileModel->getPath() . ' - ' . $temporal, true))->getEncodedMessage();
        } else {
            $_SESSION['files']['tmppath'] = '';
            $_SESSION['files']['filepath'] = "";
            $_SESSION['files']['students'] = null;
            echo (new SendMessage('Error, el archivo no fue guardado', false))->getEncodedMessage();
        }
    } else {
        $_SESSION['files']['tmppath'] = '';
        $_SESSION['files']['filepath'] = "";
        $_SESSION['files']['students'] = null;
        echo (new SendMessage('Error, el archivo debe ser un Excel', false))->getEncodedMessage();
    }
}