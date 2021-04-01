<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Nivelation - Login</title>

    <?php @include_once "app/components/dependencies.php" ?>

</head>

<body class="body-login">
    <div class="body-banner">
        <img src="public/images/OGCU.png" alt="">
    </div>
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center ">
            <div class="col-xl-6 col-lg-6 col-md-8">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <div class="login-header mt-4">
                            <img class="img-profile" src="public/images/ogcushort.png">
                            <h4 class="login-title ml-2">Nivelation</h4>
                        </div>
                        <div class="form__content" id="form__content">
                            <form class="form-user col-12" id="form-user">
                                <div class="form-group">
                                    <h4 class="form-header">Iniciar Sesión</h4>
                                </div>
                                <div class="form-group mb-4">
                                    <input type="text" class="input-user" id="username" name="username" placeholder="Nombre de usuario">
                                </div>
                                <div class="form-group login-help">
                                    <a class="mb-2" href="forgot-password.html">Forgot Password?</a>
                                    <a class="" href="register.php">Create an Account!</a>
                                </div>
                                <div class="button-content">
                                    <button class="btn btn-primary btn-block"  id="btn-next">Siguiente</button>
                                </div>
                            </form>
                            <form class="form-password col-12" id="form-password">
                                <div class="form-group form-header">
                                    <i class="fas fa-long-arrow-alt-left btn-behind" id="btn-behind"></i>
                                    <label for="">Nombre de usuario</label>
                                </div>
                                <div class="form-group">
                                    <h4 class="form-header">Escribir contraseña</h4>
                                </div>
                                <div class="form-group mb-4">
                                    <input type="text" class="input-user" id="username" name="username" placeholder="Ingrese contraseña">
                                </div>
                                <div class="form-group login-help">
                                    <a class="mb-2" href="forgot-password.html">Forgot Password?</a>
                                </div>
                                <div class="button-content">
                                    <button class="btn btn-primary btn-user btn-block" type="submit" id="bnt-pws">Siguiente</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- Custom scripts for all pages-->

    <script>
        var formUser = document.getElementById("form-user");
        var formPassword = document.getElementById("form-password");
        var bntNext = document.getElementById("btn-next");
        var bntBehind = document.getElementById("btn-behind");

        /* function ocultar(){
            
            formUser.classList.toggle("ocultar-form");
        } */
        bntNext.addEventListener("click", function(e){
            e.preventDefault();
            formUser.classList.toggle("ocultar-form");
        });
        bntBehind.addEventListener("click", function(){
            formUser.classList.toggle("ocultar-form");
        });
    </script>
<!--     <script src="public/js/login.js"></script>   -->

 <!-- Custom scripts for all pages-->
<!--  <script src="http://localhost/nivelation/public/js/sb-admin-2.min.js"></script> -->
</body>

</html>