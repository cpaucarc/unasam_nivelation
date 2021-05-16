<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(UTIL_PATH . "Teacher.php");
require_once(UTIL_PATH . "SendMessage.php");

try {
    if (isset($_POST['teacherJobID']) and isset($_POST['status'])) {
        $teacherID = $_POST['teacherJobID'];
        $status = $_POST['status'];//id 1:Activo  0:Despedido

        $teacher = new Teacher();
        $teacher->setTeacherID($teacherID);
        $teacher->setStatus($status);

        $rsp = $teacher->updateStatus();
        if ($rsp){
            echo (new SendMessage("El estado se actualizó con exito.", true))->getEncodedMessage();
        }else{
            echo (new SendMessage("No se pudo actualizar el estado", false))->getEncodedMessage();
        }
    }else{
        echo (new SendMessage("Faltan datos", false))->getEncodedMessage();
    }
} catch (Exception $e) {
    echo (new SendMessage("Error: " . $e->getMessage(), false))->getEncodedMessage();
}
