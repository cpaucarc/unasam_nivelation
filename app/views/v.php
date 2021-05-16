<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(DB_PATH . "MySqlConnection.php");

$connection = new MySqlConnection();
$pdo = $connection->getConnection();

$min = 20;
$max = 30;
$proc = 3;
$sql = "SELECT id FROM courses";
$courses = array();
foreach ($pdo->query($sql) as $row) {
    array_push($courses, $row['id']);
}

$sql = "SELECT id FROM areas";
$areas = array();
foreach ($pdo->query($sql) as $row) {
    array_push($areas, $row['id']);
}

$sql = "SELECT id FROM dimensions";
$dimensions = array();
foreach ($pdo->query($sql) as $row) {
    array_push($dimensions, $row['id']);
}

$my_query = "INSERT INTO ranks VALUES ";
foreach ($courses as $course) {
    foreach ($areas as $area) {
        $my_query .= "(null, $min, $max, $area, $course, $proc), ";
    }
}
$my_query = substr($my_query, 0, strlen($my_query) - 2) . ";";

print_r($my_query);

echo '<br><br>';

$my_query = "INSERT INTO dimension_ranks VALUES ";
foreach ($dimensions as $dimension) {
    foreach ($areas as $area) {
        if (intval($dimension) === 2 or intval($dimension) === 3 or intval($dimension) === 7) {
            $my_query .= "(null, $min, $area, $dimension, $proc), ";
        } else {
            $my_query .= "(null, 0, $area, $dimension, $proc), ";
        }
    }
}
$my_query = substr($my_query, 0, strlen($my_query) - 2) . ";";

print_r($my_query);