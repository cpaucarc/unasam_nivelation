<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>


    <!-- Custom fonts for this template
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css"
          integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="public/css/nivelation.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/style.css">

</head>

<body class="bg-gradient-primary">

<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-4">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h2 class="h5 text-gray-900 mb-4">BIENVENIDO AL
                                        SISTEMA DE NIVELACIÓN ESTUDIANTES</h2>
                                </div>
                                <form class="user" id="login-form">
                                    <div class="form-group">
                                        <label for="usuario" class="col-form-label-sm text-uppercase">PERFIL</label>
                                        <select class="form-control form-conotrol-user-combo  text-uppercase"
                                                id="semestre">
                                            <option>Amisnistrador</option>
                                            <option>Operador</option>
                                            <option>Usuario</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="username" class="col-form-label-sm text-uppercase">Usuario</label>
                                        <input type="text" class="form-control form-control-user"
                                               id="username" name="username"
                                               placeholder="Usuario">
                                    </div>
                                    <div class="form-group">
                                        <label for="password"
                                               class="col-form-label-sm text-uppercase">Contraseña</label>
                                        <input type="password" class="form-control form-control-user"
                                               id="password" placeholder="Password" name="password">
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">Remember
                                                Me</label>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-user btn-block" type="submit">Ingresar</button>

                                </form>

                                <div class="text-center">
                                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="register.php">Create an Account!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<!-- Bootstrap core JavaScript-->
<script src="public/vendor/jquery/jquery.min.js"></script>
<script src="public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="public/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="public/js/sb-admin-2.min.js"></script>

<script src="public/js/login.js"></script>
</body>

</html>