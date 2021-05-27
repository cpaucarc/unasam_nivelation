<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(UTIL_PATH . "Classroom.php");
require_once(UTIL_PATH . "SendMessage.php");


if (isset($_POST['groupIDSchedule']) and isset($_POST['rooms']) and isset($_POST['day']) and isset($_POST['time_start']) and isset($_POST['time_end'])) {

    $groupID = intval($_POST['groupIDSchedule']);
    $classroomID = intval($_POST['rooms']);
    $dayID = intval($_POST['day']);
    $timeStart = $_POST['time_start'];
    $timeEnd = $_POST['time_end'];

    if ($groupID > 0) {
        if ($dayID > 0) {
            if ($classroomID > 0) {
                $classroom = new Classroom();
                if ($classroom->verifyIfExistScheduleByDay($groupID, $dayID) === 0) {
                    $hours_diff = round((strtotime($timeEnd) - strtotime($timeStart)) / (60 * 60));
                    $current_hours = $classroom->countHoursOfScheduleByWeek($groupID);

                    $TOTAL_HOURS_BY_DIM = $classroom->getHoursByDimension($groupID);

                    if (($hours_diff + $current_hours) <= $TOTAL_HOURS_BY_DIM) {
                        $classroom->createNewSchedule($groupID, $classroomID, $dayID, $timeStart, $timeEnd);
                        echo (new SendMessage("Ok", true))->getEncodedMessage();
                    } else {
                        echo (new SendMessage("Se está sobrepasando de las horas estipuladas, solo debe haber $TOTAL_HOURS_BY_DIM horas por semana." .
                            " Ya hay $current_hours horas registradas.", false))->getEncodedMessage();
                    }
                } else {
                    echo (new SendMessage("Este grupo ya tiene clases este dia a estas horas.", false))->getEncodedMessage();
                }
            } else {
                echo (new SendMessage("Elija el salon de clases para el horario.", false))->getEncodedMessage();
            }
        } else {
            echo (new SendMessage("Elija el dia para el horario.", false))->getEncodedMessage();
        }
    } else {
        echo (new SendMessage("Falta información.", false))->getEncodedMessage();
    }
} else {
    echo (new SendMessage("Falta información.", false))->getEncodedMessage();
}
