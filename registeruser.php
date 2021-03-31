<?php
require_once "app/components/upperpart.php";
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
                                <h1 class="h4 text-gray-900 mb-4">Crear una cuenta</h1>
                            </div>
                            <form class="user">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="usuario" class="col-form-label-sm text-uppercase">Nombres</label>
                                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                               placeholder="Nombres">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="usuario" class="col-form-label-sm text-uppercase">APELLIDOS</label>
                                        <input type="text" class="form-control form-control-user" id="exampleLastName"
                                               placeholder="Apellidos">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="usuario" class="col-form-label-sm text-uppercase">USUARIO</label>
                                        <input type="text" class="form-control form-control-user" id="exampleInputEmail"
                                               placeholder="Usuario">
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="usuario" class="col-form-label-sm text-uppercase">CARGO</label>
                                        <select class="form-control form-conotrol-user-combo  text-uppercase"
                                                id="semestre">
                                            <option>Amisnistrador</option>
                                            <option>Operador</option>
                                            <option>Usuario</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="usuario" class="col-form-label-sm text-uppercase">PASSWORD</label>
                                        <input type="password" class="form-control form-control-user"
                                               id="exampleInputPassword" placeholder="Password">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="usuario" class="col-form-label-sm text-uppercase small"> REPETIR
                                            PASSWORD</label>
                                        <input type="password" class="form-control form-control-user"
                                               id="exampleRepeatPassword" placeholder="Repetir Password">
                                    </div>
                                </div>
                                <a href="http://localhost/nivelation/login" class="btn btn-primary btn-user btn-block">
                                    Regitar cuenta
                                </a>
                                <hr>

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
require_once "app/components/downpart.php";
?>