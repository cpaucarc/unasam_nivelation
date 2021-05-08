<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(DB_PATH . "MySqlConnection.php");

$stdataID = $_POST['stdID'] ?? 153;
$conn = (new MySqlConnection())->getConnection();
$sql = "CALL spShowQuestions($stdataID);";

$response = array();
foreach ($conn->query($sql) as $row) {
    $question = array();
    $question['number'] = $row['number'];
    $question['course'] = $row['course'];
    $question['response'] = $row['response'];
    $question['num'] = $row['num'];
    array_push($response, $question);
}
echo json_encode($response);