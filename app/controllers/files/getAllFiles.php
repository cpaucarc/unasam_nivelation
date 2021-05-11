<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/ogcu/dirs.php');

$main = STORAGE_PATH;

if (is_dir($main)) {

    $files = opendir($main);
    $response['files'] = array();

    while (($file = readdir($files)) !== false) {
        if ($file != "." && $file != "..") {
            $info_file = array();
            $aux = explode(".", $file);
            $info_file['name'] = substr($aux[0], 0, -17) . '.' . $aux[1];
            $info_file['size'] = formatSizeUnits(filesize($main . $file));
            $info_file['time'] = date("F d Y H:i:s.", filemtime($main . $file));
            $info_file['type'] = filetype($main . $file);
            array_push($response['files'], $info_file);
        }
    }
    closedir($files);

    echo json_encode($response);

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

