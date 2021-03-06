<?php
require_once 'dirs.php';
require_once UTIL_PATH . "sessions/SessionStarted.php";
session_start();
$sessionStarted = new SessionStarted();
$sessionStarted->verifySessionStarted();

require_once $sessionStarted->getUpperPartByUserType();
?>
<div class="container">

    <div class="card mb-4">
        <div class="card-body ">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <?php if (intval($_SESSION['user_logged']['utid']) === 1) { ?>
                    <button type="button" class="btn btn-primary btn-sm my-2" data-toggle="modal"
                            data-target="#user_modal">
                        <i class="bi bi-plus mr-2"></i>Nuevo usuario
                    </button>
                <?php } ?>
            </div>
            <div id="table-courses">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table id="table-users" class="table table-sm table-striped border">
                                <thead class="thead-light">
                                <tr>
                                    <th style="width: 30px;"><small><strong>N°</strong></small></th>
                                    <th><small><strong>DNI</strong></small></th>
                                    <th><small><strong>Apellidos y Nombres</strong></small></th>
                                    <th><small><strong>Género</strong></small></th>
                                    <th><small><strong>Tipo</strong></small></th>
                                    <th><small><strong>Usuario</strong></small></th>
                                    <th style="width: 5px;">&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody id="table-body">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Registro de Usuarios -->
    <div class="modal fade" id="user_modal" data-backdrop="static" data-keyboard="false" tabindex="-1"
         aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="user-form">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="user_dni"
                                   class="col-sm-3 col-form-label col-form-label-sm text-right">DNI</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control form-control-sm" id="user_dni"
                                       name="user_dni" pattern="\d{8}" title="El DNI debe tener 8 dígitos" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gender"
                                   class="col-sm-3 col-form-label col-form-label-sm text-right">Género</label>
                            <div class="col-sm-9">
                                <select name="gender" id="gender" class="form-control form-control-sm" required>
                                    <option value="0">Seleccione...</option>
                                    <option value="1">Femenino</option>
                                    <option value="2">Masculino</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="user_name"
                                   class="col-sm-3 col-form-label col-form-label-sm text-right">Nombres</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm" id="user_name"
                                       name="user_name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="user_lastname"
                                   class="col-sm-3 col-form-label col-form-label-sm text-right">Apellidos</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm" id="user_lastname"
                                       name="user_lastname"
                                       required>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label for="user_rol"
                                   class="col-sm-3 col-form-label col-form-label-sm text-right">Rol del usuario</label>
                            <div class="col-sm-9">
                                <select class="form-control form-control-sm" id="user_rol" name="user_rol" required>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="user_username"
                                   class="col-sm-3 col-form-label col-form-label-sm text-right">Nombre de
                                usuario</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm" id="user_username"
                                       name="user_username" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="user_password"
                                   class="col-sm-3 col-form-label col-form-label-sm text-right">Contraseña</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control form-control-sm" id="user_password"
                                       name="user_password" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-12">
                                <div class="alert alert-info my-2 alert-dismissible fade show" role="alert">
                                    <div class="row">
                                        <div class="col col-1">
                                            <h2>
                                                <i class="bi bi-info-circle-fill"></i>
                                            </h2>
                                        </div>
                                        <div class="col col-11 pl-4 pr-0">
                                            <small class="mb-0">
                                                El <strong>Nombre de usuario</strong> y <strong>Contraseña</strong>
                                                por defecto toma el valor del <strong>DNI</strong> del usuario,
                                                estos valores se pueden modificar en este formulario, o más adelante
                                                en la pantalla de perfil del usuario.
                                            </small>
                                        </div>
                                    </div>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary btn-sm">Registrar usuario
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Editar Rol  -->
    <div class="modal fade" id="rol_modal" data-backdrop="static" data-keyboard="false" tabindex="-1"
         aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <?php if (intval($_SESSION['user_logged']['utid']) === 1) { ?>
                    <form id="rol-form">
                        <div class="modal-body">
                            <input type="hidden" name="id_user" id="id_user" value="0">
                            <div class="form-group">
                                <label for="user_roles" class="col-form-label col-form-label-sm">Rol de <span
                                            id="span_username"></span></label>
                                <select class="form-control form-control-sm" id="user_roles" name="user_rol" required>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary btn-sm">Cambiar Rol</button>
                        </div>
                    </form>
                <?php } else { ?>
                    <p>Usuario no autorizado</p>
                <?php } ?>
            </div>
        </div>
    </div>

</div>

<script src="public/js/components/SweetAlerts.js"></script>
<script src="public/js/components/Table.js"></script>
<script src="public/js/components/Button.js"></script>
<script src="public/js/user.js"></script>

<?php
require_once COMPONENT_PATH . "downpart.php";
?>
