<?php
require_once "app/components/upperpart.php";
?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Usuarios registrados</h1>
    </div>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#user_modal">
            <i class="fas fa-plus"></i> Nuevo usuario
        </button>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabla usuarios</h6>
        </div>
        <div class="card-body ">
            <div id="table-courses">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table id="example1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>DNI</th>
                                        <th>Nombre</th>
                                        <th>Rol</th>
                                        <th>Usuario</th>
                                        <th>Acción</th>
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
    <!-- Modal -->
    <div class="modal fade" id="user_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Registrar Nuevo Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="user-form">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="user_dni">DNI</label>
                            <input type="text" class="form-control" id="user_dni" name="user_dni">
                        </div>
                        <div class="form-group">
                            <label for="user_name">Nombres</label>
                            <input type="text" class="form-control" id="user_name" name="user_name">
                        </div>
                        <div class="form-group">
                            <label for="user_lastname">Apellidos</label>
                            <input type="text" class="form-control" id="user_lastname" name="user_lastname">
                        </div>
                        <div class="form-group">
                            <label for="user_rol">Rol del usuario</label>
                            <select class="form-control" id="user_rol" name="user_rol">
                                <option>System Administrator</option>
                                <option>Resource Viewer</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="user_username">Nombre de Usuario</label>
                            <input type="text" class="form-control" id="user_username" name="user_username">
                        </div>
                        <div class="form-group">
                            <label for="user_password">Contraseña</label>
                            <input type="password" class="form-control" id="user_password" name="user_password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Registrar usuario
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
require_once "app/components/downpart.php";
?>
<script src="public/js/user.js"></script>
<script src="public/js/datatable.js"></script>