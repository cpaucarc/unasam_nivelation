<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(UTIL_PATH . "sessions/SessionStarted.php");
session_start();
(new SessionStarted())->verifySessionStarted();
?>
<?php
require_once(COMPONENT_PATH . "upperpart.php");
?>
<div class="container">
    <div class="row">
        <div class="col-xl-6 col-lg-6">
            <div class="card mb-4">
                <div class="card-header text-center">
                    <h3 class=" text-uppercase">Mamani Quispe</h3>
                    <h3 class="text-uppercase small">Gonzalo</h3>
                    <div class="text-center">
                        <label class="text-uppercase">DNI:</label>
                        <label class="text-uppercase">12312312</label>
                    </div>
                </div>
                <div class="card-body ">
                    <form class="user">
                        <div class="form-group">
                            <label for="usuario" class="col-form-label-sm text-uppercase">Nombres</label>
                            <input type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="Nombres">
                        </div>

                        <div class="form-group">
                            <label for="usuario" class="col-form-label-sm text-uppercase">APELLIDOS</label>
                            <input type="text" class="form-control form-control-user" id="exampleLastName" placeholder="Apellidos">
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary btn-user btn-block my-1">
                            Actualizar
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6">
            <div class="card mb-4 text-center">
                <!-- <div class="card-header">
                    <label class="text-uppercase">Usuario:</label>
                    <label class="text-uppercase">Gonzalo</label>
                </div> -->
                <div class="card-body">
                    <form class="user text-left">
                        <div class="form-group">
                            <label for="usuario" class="col-form-label-sm text-uppercase">NUEVO PASSWORD</label>
                            <input type="password" class="form-control form-control-user" id="exampleInputEmail" placeholder="Password">
                        </div>
                        <div class="form-group mb-4">
                            <label for="usuario" class="col-form-label-sm text-uppercase">CONFIRMAR PASSWORD</label>
                            <input type="password" class="form-control form-control-user" id="exampleInputEmail" placeholder="Confirmar password">
                        </div>
                        <hr>
                        <div class="form-group mt-2">
                            <label for="usuario" class="col-form-label-sm text-uppercase">PASSWORD ACTUAL</label>
                            <input type="password" class="form-control form-control-user" id="exampleInputEmail" placeholder="Password actual">
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Actualizar
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once(COMPONENT_PATH . "downpart.php");
?>