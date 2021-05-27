<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(DB_PATH . "MySqlConnection.php");

$grupo = 2;
$clase = 1;

$conn = (new MySqlConnection())->getConnection();
$sql = "SELECT IF((SELECT id FROM class_data WHERE groups_id = 2 AND date_format(time_class, '%Y-%m-%d') = curdate() LIMIT 1) IS NULL, 0, (SELECT id FROM class_data WHERE groups_id = 2 AND date_format(time_class, '%Y-%m-%d') = curdate() LIMIT 1));";

echo $conn->query($sql)->fetchColumn() ?? 0;
