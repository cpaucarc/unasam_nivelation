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

<body style="background: #FAFBFC">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-12 col-md-8">
            <div class="card o-hidden rounded-lg shadow my-5 bg-light">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-5 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-7">
                            <div class="p-5">
                                <h5 class="mb-4 font-weight-bold text-black">
                                    Bienvenido al Sistema de Nivelación de Estudiantes
                                </h5>
                                <form id="login-form" class="user my-3">

                                    <div class="form-group">
                                        <label for="username" class="text-dark">Nombre de Usuario</label>
                                        <input type="text" class="form-control form-control-user" id="username"
                                               name="username">
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="text-dark">Contraseña</label>
                                        <input type="password" class="form-control form-control-user" id="password"
                                               name="password">
                                    </div>
                                    <div class="mt-4">
                                        <button class="btn btn-primary btn-user btn-block font-weight-bold"
                                                type="submit">
                                            Ingresar
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
<script src="public/js/login.js"></script>
</body>

</html>