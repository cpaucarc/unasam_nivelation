<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(DB_PATH . "MySqlConnection.php");
$connection = new MySqlConnection();
$dni = 61257784;
if ($connection) {
    $pdo = $connection->getConnection();
    $sql = "SELECT count(1) as num FROM persons WHERE dni = '" . $dni . "'";
    $num = $pdo->query($sql)->fetchColumn();
    echo $num;
    var_dump($num);
    $num = intval($num);
    if ($num === 0) {

        echo "Aun no existe";
    } else {
        echo "Ya existe";
    }
    var_dump($num);
} else {
    return false;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
          integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<div class="container mt-5">
    <h1>Hello</h1>
</div>
</body>
</html>
