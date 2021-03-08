<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>

    <?php @include_once "app/components/dependencies.php" ?>

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Crear una cuenta</h1>
                            </div>
                            <form class="user">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="usuario" class="col-form-label-sm text-uppercase">Nombres</label>
                                        <input type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="Nombres">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="usuario" class="col-form-label-sm text-uppercase">APELLIDOS</label>
                                        <input type="text" class="form-control form-control-user" id="exampleLastName" placeholder="Apellidos">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="usuario" class="col-form-label-sm text-uppercase">USUARIO</label>
                                    <input type="text" class="form-control form-control-user" id="exampleInputEmail" placeholder="Usuario">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="usuario" class="col-form-label-sm text-uppercase">PASSWORD</label>
                                        <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="usuario" class="col-form-label-sm text-uppercase small"> REPETIR PASSWORD</label>
                                        <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repetir Password">
                                    </div>
                                </div>
                                <a href="login.php" class="btn btn-primary btn-user btn-block">
                                    Regitar cuenta
                                </a>
                                <hr>

                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.html">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>