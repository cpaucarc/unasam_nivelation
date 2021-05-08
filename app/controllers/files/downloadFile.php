<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');

$main = STORAGE_PATH;
$name = $_POST['name'];

$filename = basename($name);
// Specify file path.
$path = ''; // '/uplods/'
$download_file = $main . $filename;

if (!empty($filename)) {
    // Check file is exists on given path.
    if (file_exists($download_file)) {
        header('Content-Disposition: attachment; filename=' . $filename);
        readfile($download_file);
        echo 'Ok';
        exit;
    } else {
        echo 'File does not exists on given path';
    }
}