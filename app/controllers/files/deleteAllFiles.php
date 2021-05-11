<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/ogcu/dirs.php');

$main = STORAGE_PATH;

if (is_dir($main)) {

    $files = opendir($main);
    while (($file = readdir($files)) !== false) {
        if ($file != "." && $file != "..") {
            try {
                if (filetype($main . $file) === 'dir') {
                    rmdir($main . $file);
                } else {
                    $response = unlink($main . $file);
                }
            } catch (Exception $e) {
            }
        }
    }
    closedir($files);
    echo 'Archivos eliminados';
} else {
    echo 'Archivos no eliminados';
}