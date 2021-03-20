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

    $fileModel = new FileModel();
    $fileModel->setName($name);
    $fileModel->setSize($size);
    $fileModel->setType($type);
    $fileModel->setTemporalDir($temporal);

    $rsp = $fileModel->moveFileToFinalDir();

    if ($rsp) {
        echo $fileModel->getPath();
    } else {
        echo 'Error';
    }

}