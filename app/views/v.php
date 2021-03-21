<?php
//
//if (isset($_SESSION['user'])) {
//    echo 'Hay session' . $_SESSION['user'];
//} else {
//    header("Location: http://localhost/nivelation/login.php", TRUE, 301);
//    exit();
//}

//include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
////require_once(MODEL_PATH . "StudentModel.php");
//require_once(CONTROLLER_PATH . "StudentController.php");
//
//$std = new StudentController();
//
//$path = 'C:\xampp\htdocs\nivelation\public\js\prueba.json';
//
////var_dump($std->loadStudentsFromJSON($path));
//print_r($std->loadStudentsFromJSON($path));
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(MODEL_PATH . "FileModel.php");
require_once(UTIL_PATH . "SendMessage.php");

$fileModel = new FileModel();
echo $fileModel->generateName('file me.json');


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
    <form action="../controllers/index/saveUploadFile.php" method="post" name="miformu" enctype="multipart/form-data"
          id="miformu">
        <input name="file" type="file" id="upload">

        <button type="submit" name="submit">Subir</button>
    </form>


    <script>
        // const upload = document.getElementById('upload');
        // const miformu = document.getElementById('miformu');
        //
        // miformu.addEventListener('submit', (e) => {
        //     e.preventDefault();
        //     console.log('Sended');
        //     let formData = new FormData(miformu);
        //
        //     fetch('http://localhost/nivelation/app/controllers/index/saveUploadFile.php/', {
        //         method: 'POST',
        //         body: formData
        //     })
        //         .then(response => response.text())
        //         .then(data => {
        //             console.log(data);
        //         });
        // });


    </script>
</div>
</body>
</html>
