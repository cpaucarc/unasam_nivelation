<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <?php @include_once "app/components/dependencies.php" ?>

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
                                    <form class="user">
                                        <div class="form-group">
                                            <label for="usuario" class="col-form-label-sm text-uppercase">PERFIL</label>
                                            <select class="form-control form-conotrol-user-combo  text-uppercase" id="semestre">
                                                <option>Amisnistrador</option>
                                                <option>Operador</option>
                                                <option>Usuario</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="usuario" class="col-form-label-sm text-uppercase">USUARIO</label>
                                            <input type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Usuario">
                                        </div>
                                        <div class="form-group">
                                            <label for="usuario" class="col-form-label-sm text-uppercase">PASSWORD</label>
                                            <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <a href="index.php" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </a>
                                        <hr>

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

</body>

</html>