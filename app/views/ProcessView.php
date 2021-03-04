<?php
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Procesos de Admisión</title>
</head>
<body>
<form id="form">
    <label for="denomination">Proceso</label>
    <input type="text" name="denomination" id="denomination" placeholder="2020-I">
    <button type="submit">Registrar</button>
</form>

<button id="btn">watch</button>
<div id="process">
    <table>
        <thead>
        <th>N°</th>
        <th>Proceso de Admision</th>
        <th>Update</th>
        <th>Delete</th>
        </thead>
        <tbody id="table-body">

        </tbody>
    </table>

</div>

</body>
<script src="../../public/js/process.js"></script>
</html>
