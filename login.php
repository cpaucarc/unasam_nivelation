<?php
session_start();
$error_message = $_SESSION['login']['error'] ?? '';
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

<body>

<div class="container">
    <div class="row justify-content-center mt-4">

        <div class="col-11 col-md-6 col-xl-4 px-3">
            <div class="text-center py-3">
                <img src="public/images/ogcushort.png" class="img-fluid w-25" alt="Logo">
                <h5 class="font-weight-lighter text-dark">
                    Iniciar sesión en SNE-UNASAM
                </h5>
            </div>

            <?php
            if (strlen($error_message) > 0) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <small><?php echo $_SESSION['login']['error'] ?? ''; ?></small>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } ?>


            <div class="card bg-light">
                <div class="card-body px-4 py-3">
                    <form class="user my-3" action="app/controllers/login/makeLogin.php" method="post">
                        <div class="form-group">
                            <label for="username" class="col-form-label col-form-label-sm">Nombre de
                                Usuario</label>
                            <input type="text" class="form-control form-control-sm" id="username"
                                   name="username" value="<?php echo $_SESSION['login']['user'] ?? ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="password"
                                   class="col-form-label col-form-label-sm">Contraseña</label>
                            <input type="password" class="form-control form-control-sm" id="password"
                                   name="password" required>
                        </div>
                        <div class="mt-4">
                            <button class="btn btn-primary btn-sm btn-block font-weight-bold"
                                    type="submit">
                                Iniciar Sesión
                            </button>
                        </div>
                    </form>
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