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
    <meta name="description" content="Sistema de Nivelación de Ingresantes">
    <meta name="author" content="UNASAM">
    <link rel="icon" href="public/images/ogcushort.png" type="image/x-icon"/>
    <title>Login</title>

    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">

    <!-- Own -->
    <link rel="stylesheet" href="public/css/nivelation.css">
    <link rel="stylesheet" href="public/css/style.css">

</head>

<body>

<div class="container">
    <div class="row justify-content-center mt-4">

        <div class="col-11 col-md-6 col-xl-4 px-3">
            <div class="text-center py-3">
                <img src="public/images/ogcushort.png" class="img-fluid w-25" alt="Logo" loading="lazy">
                <h5 class="font-weight-lighter text-dark">
                    Iniciar sesión en PNI-UNASAM
                </h5>
            </div>

            <?php
            if (strlen($error_message) > 0) { ?>
                <div class="alert alert-danger " role="alert">
                    <small><?php echo $_SESSION['login']['error'] ?? ''; ?></small>
                </div>
            <?php } ?>

            <div class="card bg-light">
                <div class="card-body px-4 py-3">
                    <form class="user my-3" action="make-login" method="post">
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
</body>

</html>