<?php
require_once "app/views/upperpart.php";
?>


<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="card o-hidden border-0  ">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Editar Contraseña</h1>
                        </div>
                        <form class="user">
                            <div class="form-group">
                                <label for="usuario" class="col-form-label-sm text-uppercase">NUEVO PASSWORD</label>
                                <input type="password" class="form-control form-control-user" id="exampleInputEmail" placeholder="Password">
                            </div>
                            <div class="form-group mb-4">
                                <label for="usuario" class="col-form-label-sm text-uppercase">CONFIRMAR  PASSWORD</label>
                                <input type="password" class="form-control form-control-user" id="exampleInputEmail" placeholder="Confirmar password">
                            </div>
                            <hr>
                            <div class="form-group mt-2">
                                <label for="usuario" class="col-form-label-sm text-uppercase">PASSWORD ACTUAL</label>
                                <input type="password" class="form-control form-control-user" id="exampleInputEmail" placeholder="Password actual">
                            </div>

                            <a href="login.php" class="btn btn-primary btn-user btn-block">
                                Guardar
                            </a>

                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="forgot-password.html">Forgot Password?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?php
require_once "app/views/downpart.php";
?>