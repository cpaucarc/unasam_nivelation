<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(DB_PATH . "MySqlConnection.php");
require_once(UTIL_PATH . "SendMessage.php");

$conn = (new MySqlConnection())->getConnection();
$sql = "SELECT name FROM areas ORDER BY name;";
$areas = $conn->query($sql);

$lista = '';
$response = 0;
foreach ($areas as $area) {
    $name = $area['name'];
    $sql1 = "call spShowMissingCourses('" . $name . "');";
    $rsp = $conn->query($sql1)->fetch();
    $stat = intval($rsp['stat']);
    if ($stat === 1) {
        $message = $rsp['message'];
        $lista .= '<li class="mb-2">Cursos sin rango en <strong>area ' . $name . '</strong>: ' . $message . '</li>';
        $response = $stat;
    }
}
if (strlen($lista) === 0) {
    $lista = '<li>Todos los cursos tienen un rango, puede subir el archivo</li>';
} else {
    $lista .= '<div class="mt-4">Para solucionar esto, <a class="font-weight-bold" href="areas">pulse aqui</a>.</div>';
}

//si response = 1, entonces no se puede subir el archivo excel
echo (new SendMessage($lista, $response))->getEncodedMessage();