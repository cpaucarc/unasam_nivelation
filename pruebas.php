<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(DB_PATH . "MySqlConnection.php");

$groupID = 26;
$clase = 1;
$DEFAULT_QUALIFICATION = 0;

$conn = (new MySqlConnection())->getConnection();
$sql = "SELECT student_data_id FROM student_group WHERE groups_id = $groupID;";
$my_query = "INSERT INTO qualifications (qualification_final, groups_id, student_data_id) VALUES ";

if ($conn->query($sql)->rowCount() > 0) {

    foreach ($conn->query($sql) as $row) {
        $my_query .= "($DEFAULT_QUALIFICATION,$groupID, " . $row['student_data_id'] . "), ";
    }

    $my_query = substr($my_query, 0, strlen($my_query) - 2) . ";";

    //$conn->query($my_query);
}

echo $my_query;
