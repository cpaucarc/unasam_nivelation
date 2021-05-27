<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(UTIL_PATH . "Classroom.php");
require_once(UTIL_PATH . "SendMessage.php");

try {
    if (isset($_POST['process']) and isset($_POST['area']) and isset($_POST['dimension'])) {
        $procID = $_POST['process'];
        $areaID = $_POST['area'];
        $dimID = $_POST['dimension'];

        if ($procID > 0 and $areaID > 0 and $dimID > 0) {
            $classroom = new Classroom();
            echo $classroom->countName($procID, $areaID, $dimID);
        } else {
            echo 1;
        }
    } else {
        echo 1;
    }
} catch (Exception $e) {
    echo 1;
}