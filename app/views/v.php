<?php
//
//if (isset($_SESSION['user'])) {
//    echo 'Hay session' . $_SESSION['user'];
//} else {
//    header("Location: http://localhost/nivelation/login.php", TRUE, 301);
//    exit();
//}


include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(MODEL_PATH . "ProcessModel.php");
require_once(MODEL_PATH . "StudentModel.php");
require_once(MODEL_PATH . "UserModel.php");

$p = new ProcessModel();
echo $p->getLastProcess();

$std = new StudentModel();
$std->setId(5);
$std = $std->findByID();
$newStd = array(
    "name" => $std->getName(),
    "lastname" => $std->getLastname(),
    "school" => $std->getSchool()
);

echo '<pre>';
echo json_encode($newStd);
echo '</pre>';


//$user = new UserModel();
//echo $user->getAllUsers();

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
    <style>
        .avatar {
            display: block;
            border: 1px solid #0f6848;
            background-color: #1cc88a;
            font-size: 1.5rem;
            text-align: center;
            padding: 1rem;
        }
    </style>
</head>
<body>

<div id="div" class="container">
    <h1>Hero</h1>


    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col col-sm-12 col-md-2 d-flex justify-content-center">
                    <span class="">FP</span>
                    <strong>Ingenieria de Sistemas e Informatica</strong>
                </div>
                <div class="col col-sm-12 col-md-10">
                    <strong>Paucar Colonia Frank Cesar</strong>
                    <p>712.2587.321</p>
                    <p>96587410</p>
                </div>
            </div>
        </div>
    </div>


</div>

</body>

</html>

