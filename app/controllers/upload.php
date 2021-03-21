<?php

/**
 *funcion para mostrar json en pantall 
 *
 * @param integer $status
 * @param string $php_errormsg
 * @param array $data
 * @return void
 */

function json_output($status = 200, $msg = 'Ok', $data = null)
{
    header('Content-Type:aplication/json');
    echo json_encode([
        'status' => $status,
        'msg' => $msg,
        'data' => $data
    ]);
    die;
}


//Lógica de proceso

//Validamos la existencia del parametor con el archivo
if (!isset($_FILES['file'])) {
    json_output(403, 'Archivo no válido');
}
$path = '';
$file = $_FILES['file']; //Archivo temporal en espera de ser procesado
$path = '../../others/documents/'; //Donde vamos a guardar el archivo


//Si no existe el folder, se crea
if (!is_dir($path)) {
    mkdir(($path));
}


$uploaded = move_uploaded_file($file['tmp_name'], $path . $file['name']); //Movemos el archivo a un directorio en un servidor

$path = 'others/documents/';
if (!$uploaded) {
    json_output(400, '¡Problemas al subir el archivo!');
}

json_output(200, 'Archivo subido con éxito', $path . $file['name']);
