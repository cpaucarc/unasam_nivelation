<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');

$main = STORAGE_PATH;

if (is_dir($main)) {

    $files = opendir($main);
    $size = 0;
    $count = 0;
    while (($file = readdir($files)) !== false) {
        if ($file != "." && $file != "..") {
            $count++;
            $size += filesize($main . $file);
        }
    }
    closedir($files);

    echo json_encode(array('size' => formatSizeUnits($size), 'count' => $count));

}

function formatSizeUnits($bytes)
{
    if ($bytes >= 1073741824) {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    } elseif ($bytes > 1) {
        $bytes = $bytes . ' bytes';
    } elseif ($bytes == 1) {
        $bytes = $bytes . ' byte';
    } else {
        $bytes = '0 bytes';
    }
    return $bytes;
}

