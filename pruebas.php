<?php
$saveFailed = array();
$save = array();

array_push($saveFailed, array(
    'num' => 1,
    'student' => 'Juanito Churuca',
    'codigo' => '123.456.789'
));

array_push($saveFailed, array(
    'num' => 10,
    'student' => 'Caroline Churuca',
    'codigo' => '178.456.789'
));

array_push($saveFailed, array(
    'num' => 10,
    'student' => 'Dayane Woman',
    'codigo' => '161.456.789'
));

print_r($saveFailed);


echo '<br><br><br>';

echo json_encode($saveFailed, count($saveFailed), 10);

echo '<br><br><br>';

echo json_encode(['msg' => 'ok']);

echo '<br><br><br>';

array_push($save, array(
    'estudiantes' => $saveFailed,
    'fallos' => count($saveFailed),
    'correcto' => 10
));

echo json_encode($save);

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<small>
    <ol>
        <li>
            <pre>Numero<strong>20</strong>   Codigo: <strong>123</strong>   Alumno: <strong>Juna</strong></pre>
        </li>
        <li>Numero<strong>20</strong> Codigo: <strong>123</strong> Alumno: <strong>Juna</strong></li>
        <li>Numero<strong>20</strong> Codigo: <strong>123</strong> Alumno: <strong>Juna</strong></li>
    </ol>
</small>
</body>
</html>
