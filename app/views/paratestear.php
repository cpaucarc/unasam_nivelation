<?php
try {
    $mbd = new PDO("mysql:host=localhost;dbname=test", "root", "1234");
    echo "Connected\n";
} catch (Exception $e) {
    die("No se pudo conectar: " . $e->getMessage());
}

try {
    $mbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $mbd->beginTransaction();
    $mbd->exec("insert into staff (id, name, age) values (null , 'Tory Vega', 23)");
    $mbd->exec("insert into staff (id, name, age) values (null , 'Peter Parker', 29)");
    $mbd->exec("insert into staff (id, name, age) values (null , 'Yosu Kitamoshi', 35)");
//    $mbd->commit();

} catch (Exception $e) {
    $mbd->rollBack();
    echo "Fallo: " . $e->getMessage();
}
?>