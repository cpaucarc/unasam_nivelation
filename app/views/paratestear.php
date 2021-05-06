<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(DB_PATH . "MySqlConnection.php");
//try {
//    $mbd = new PDO("mysql:host=localhost;dbname=test", "root", "1234");
//    echo "Connected\n";
//} catch (Exception $e) {
//    die("No se pudo conectar: " . $e->getMessage());
//}
//
//try {
//    $mbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//
//    $mbd->beginTransaction();
//    $mbd->exec("insert into staff (id, name, age) values (null , 'Tory Vega', 23)");
//    $mbd->exec("insert into staff (id, name, age) values (null , 'Peter Parker', 29)");
//    $mbd->exec("insert into staff (id, name, age) values (null , 'Yosu Kitamoshi', 35)");
////    $mbd->commit();
//
//} catch (Exception $e) {
//    $mbd->rollBack();
//    echo "Fallo: " . $e->getMessage();
//}

$connection = new MySqlConnection();
if ($connection) {
    echo 'Si hay conexion <br>';
    $pdo = $connection->getConnection();
    $num = 56;
    $sql = "CALL spCountCoursesMissing()";
    $ex = $pdo->prepare($sql);
    $ex->execute();
    $nu = intval($ex->fetchColumn());
    var_dump($nu);
    echo '<br>';
} else {
    echo 'No hay conexion';
}


//session_start();
//var_dump($_SESSION['files']);

?>