<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(MODEL_PATH . "CoursesModel.php");
require_once(UTIL_PATH . "SendMessage.php");

try {
    $area = $_POST['area'];
    $courses = new CoursesModel();
    echo($courses->getCoursesByAreaAndLastProcess($area));

} catch (Exception $e) {
    echo (new SendMessage("Error " . $e->getMessage(), false))->getEncodedMessage();
}
