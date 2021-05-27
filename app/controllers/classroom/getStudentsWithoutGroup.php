<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(UTIL_PATH . "Classroom.php");

if (isset($_POST['groupID'])) {
    
    $classroom = new Classroom();
    echo $classroom->getStudentsWithoutGroup(intval($_POST['groupID']));
}
