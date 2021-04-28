<?php
require_once '../../dirs.php';
require_once(DB_PATH . "MySqlConnection.php");
session_start();

$name = 'Frank Cesare Fop';
$lastname = 'Paucar Colonia Lopez';
$dni = 'Paucar Colonia Lopez';
$id = 1;

$connection = new MySqlConnection();
if ($connection) {
    $pdo = $connection->getConnection();
    $sql = "SELECT curdate(), concat('Hola ', ?);";
    $exec = $pdo->prepare($sql)->execute([
        $name
    ]);

    echo $sql;
    echo '<br>';
    echo $exec;
    echo '<br>';
    echo $pdo->query("SELECT curdate();")->fetchAll();
    echo '<br>';
    $sql = "CALL spUpdatePersonPersonalInfo('$name', '$lastname', '$dni', $id);";
    $response = intval($pdo->query($sql)->fetchColumn());
    var_dump($response);
    echo '<br>';
    echo $response;
    echo '<br>';
    echo $_SESSION['user_logged']['id'];
    echo '<br>';
    var_dump($_SESSION['user_logged']['id']);


}