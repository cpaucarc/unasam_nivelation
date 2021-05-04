<?php
$error_message = $_GET['error'] ?? "";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="public/images/ogcushort.png" type="image/x-icon"/>
    <title>Login</title>
    <?php @include_once "app/components/dependencies.php" ?>

</head>

<body class="bg-gradient-dark">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-12 col-md-8">
            <div class="card o-hidden my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-5 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-7">
                            <div class="p-5">
                                <h5 class="mb-4 font-weight-bold text-black">
                                    Bienvenido al Sistema de Nivelación de Estudiantes
                                </h5>
                                <form class="user my-3" action="app/controllers/login/makeLogin.php" method="post">
                                    <div class="form-group">
                                        <label for="role" class="col-form-label col-form-label-sm">Tipo de Usuario</label>
                                        <select class="form-control" id="role" name="role" required>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="username"  class="col-form-label col-form-label-sm">Nombre de Usuario</label>
                                        <input type="text" class="form-control" id="username"
                                               name="username" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="col-form-label col-form-label-sm">Contraseña</label>
                                        <input type="password" class="form-control" id="password"
                                               name="password" required>
                                    </div>
                                    <div class="mt-4">
                                        <button class="btn btn-primary btn-sm btn-block"
                                                type="submit">
                                            <i class="bi bi-box-arrow-in-right"></i> Ingresar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Custom scripts for all pages-->
<script src="public/js/sb-admin-2.min.js"></script>
<script src="public/js/components/Select.js"></script>
<script> var errormsg = '<?php echo $error_message;?>';</script>
<script src="public/js/login.js"></script>
</body>

</html>