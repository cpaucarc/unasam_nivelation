<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');

$main = STORAGE_PATH;
$filename = $_POST['name'];

if (is_dir($main)) {
    try {
        $response = unlink($main . $filename);
        if ($response) {
            echo json_encode(array('message' => $filename . ' fue eliminado'));
        } else {
            echo json_encode(array('message' => $filename . ' no pudo ser eliminado'));
        }
    } catch (Exception $e) {
        echo json_encode(array('message' => 'Error: ' . $e));
    }
}
