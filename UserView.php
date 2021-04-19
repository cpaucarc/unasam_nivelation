<?php
require_once 'dirs.php';
require_once UTIL_PATH . "sessions/SessionStarted.php";
session_start();
(new SessionStarted())->verifySessionStarted();
require_once COMPONENT_PATH . "upperpart.php";
?>
<div class="container">

    <div class="card mb-4">
        <div class="card-body ">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#user_modal">
                    <i class="fas fa-plus"></i> Nuevo usuario
                </button>
            </div>
            <div id="table-courses">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table id="table-users" class="table table-sm table-bordered">
                                <thead class="thead-light">
                                <tr>
                                    <th style="width: 30px;">#</th>
                                    <th>DNI</th>
                                    <th>Nombre</th>
                                    <th>Rol</th>
                                    <th>Usuario</th>
                                    <th>&nbsp;</th>
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
                        <div class="form-group">
                            <label for="user_dni">DNI</label>
                            <input type="number" class="form-control" id="user_dni" name="user_dni" required
                                   maxlength="8" minlength="8" size="8">
                        </div>
                        <div class="form-group">
                            <label for="user_name">Nombres</label>
                            <input type="text" class="form-control" id="user_name" name="user_name" required>
                        </div>
                        <div class="form-group">
                            <label for="user_lastname">Apellidos</label>
                            <input type="text" class="form-control" id="user_lastname" name="user_lastname" required>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="user_rol">Rol del usuario</label>
                            <select class="form-control" id="user_rol" name="user_rol" required>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="user_username">Nombre de Usuario</label>
                            <input type="text" class="form-control" id="user_username" name="user_username" required>
                        </div>
                        <div class="form-group">
                            <label for="user_password">Contraseña</label>
                            <input type="password" class="form-control" id="user_password" name="user_password"
                                   required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Registrar usuario
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
                <form id="rol-form">
                    <div class="modal-body">
                        <input type="text" name="id_user" id="id_user" value="0">
                        <div class="form-group">
                            <label for="user_roles">Rol de <span id="span_username"></span></label>
                            <select class="form-control" id="user_roles" name="user_rol" required>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Cambiar Rol
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<script src="public/js/components/Table.js"></script>
<script src="public/js/components/Button.js"></script>
<script src="public/js/user.js"></script>

<?php
require_once COMPONENT_PATH . "downpart.php";
?>
