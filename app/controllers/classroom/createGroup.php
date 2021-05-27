<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(UTIL_PATH . "Classroom.php");
require_once(UTIL_PATH . "SendMessage.php");

try {
    if (isset($_POST['process']) and isset($_POST['area']) and isset($_POST['dimension']) and isset($_POST['date_start']) and isset($_POST['date_end'])) {
        $groupID = intval($_POST['groupID']);
        $procID = $_POST['process'];
        $areaID = $_POST['area'];
        $dimID = $_POST['dimension'];
        $teacherID = $_POST['teacherID'];
        $dateStart = $_POST['date_start'];
        $dateEnd = $_POST['date_end'];
        $groupName = $_POST['groupName'];

        if ($procID > 0) {
            if ($areaID > 0) {
                if ($dimID > 0) {
                    $start = strtotime($dateStart);
                    $end = strtotime($dateEnd);
                    $days = round(($end - $start) / (60 * 60 * 24));
                    $MIN_DAY = 13;
                    $MAX_DAY = 15;

                    if ($days >= $MIN_DAY && $days <= $MAX_DAY) {
                        $classroom = new Classroom();
                        if ($groupID > 0) {
                            if ($classroom->editGroup($groupID, $procID, $areaID, $dimID, $dateStart, $dateEnd, $teacherID, $groupName)) {
                                echo (new SendMessage(-1, true))->getEncodedMessage();
                            } else {
                                echo (new SendMessage("No se pudo guardar la información del grupo.", false))->getEncodedMessage();
                            }
                        } else {
                            if ($classroom->createNewGroup($procID, $areaID, $dimID, $dateStart, $dateEnd, $teacherID, $groupName)) {
                                echo (new SendMessage($classroom->getGroupID($procID, $areaID, $dimID, $groupName), true))->getEncodedMessage();
                            } else {
                                echo (new SendMessage("No se pudo guardar la información del grupo.", false))->getEncodedMessage();
                            }
                        }
                    } else {
                        echo (new SendMessage("La duración debe ser de 2 semanas. Actualmente hay $days dias de diferencia", false))->getEncodedMessage();
                    }
                } else {
                    echo (new SendMessage("Falta elegir la dimension/curso para el grupo", false))->getEncodedMessage();
                }
            } else {
                echo (new SendMessage("Falta elegir el area para el grupo", false))->getEncodedMessage();
            }
        } else {
            echo (new SendMessage("Falta elegir el proceso de admision", false))->getEncodedMessage();
        }
    } else {
        echo (new SendMessage("Faltan Datos", false))->getEncodedMessage();
    }
} catch (Exception $e) {
    echo (new SendMessage("Error:" . $e, false))->getEncodedMessage();
}
