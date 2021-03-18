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
    <div class="row">
        <div class="col col-md-5 col-sm-12 mb-3">
            <div class="card bg-light">
                <div class="card-body">
                    <div class="col col-12">
                        <h4>
                            <span class="text-uppercase font-weight-bold">Paucar Colonia</span>
                        </h4>
                        <h4>
                            <span class="text-capitalize">Frank César</span>
                        </h4>
                    </div>
                    <div class="col-lg-12 mt-4">
                        <h3 class="text-uppercase small">
                            <span class="text-uppercase font-weight-bold">Escuela: </span>
                            Ingenieria de Sistemas e Informatica
                        </h3>
                    </div>
                    <div class="col-lg-12">
                        <h3 class="text-uppercase small">
                            <span class="text-uppercase font-weight-bold">Admision: </span>
                            2019-II
                        </h3>
                    </div>
                    <div class="col-lg-6">
                        <h3 class="text-uppercase small">
                            <span class="text-uppercase font-weight-bold">DNI: </span>
                            7041368
                        </h3>
                    </div>
                    <div class="col-lg-6 my-2">
                        <h3 class="text-uppercase small">
                            <span class="text-uppercase font-weight-bold">Código: </span>
                            171.0147.216
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col col-sm-12 col-md-7">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>
