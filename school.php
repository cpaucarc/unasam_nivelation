<?php
require_once('dirs.php');
require_once(UTIL_PATH . "sessions/SessionStarted.php");
session_start();
$sessionStarted = new SessionStarted();
$sessionStarted->verifySessionStarted();

require_once $sessionStarted->getUpperPartByUserType();
?>


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="card border-left-primary shadow h-100 ">
            <div class="card-body">
                <div class="text-md font-weight-bold text-primary text-uppercase">
                    Grupo (<span class="area">A</span>)
                </div>
            </div>
        </div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-sm my-2" data-toggle="modal" data-target="#school_modal">
            <i class="bi bi-plus mr-2"></i>Nuevo programa
        </button>
    </div>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Escuelas</h6>
        </div>
        <div class="card-body ">
            <div class="table-responsive">
                <table id="example2" class="table table-striped border" cellspacing="0" width="100%">
                    <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>Ingeniería de Sistemas e Informática</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button class="btn btn-warning btn-sm btnEditar" data-toggle="modal"
                                        data-target="#school_modal"><i class="bi bi-pencil-square"></i></button>
                                <button class="btn btn-danger btn-sm btnEliminar"><i class="bi bi-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Ingeniería de Civil</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button class="btn btn-warning btn-sm btnEditar" data-toggle="modal"
                                        data-target="#school_modal"><i class="bi bi-pencil-square"></i></button>
                                <button class="btn btn-danger btn-sm btnEliminar"><i class="bi bi-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Ingeniería de Industrial</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button class="btn btn-warning btn-sm btnEditar" data-toggle="modal"
                                        data-target="#school_modal"><i class="bi bi-pencil-square"></i></button>
                                <button class="btn btn-danger btn-sm btnEliminar"><i class="bi bi-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->


<!-- Logout Modal-->
<div class="modal fade" data-backdrop="static" id="school_modal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="escuela" class="col-form-label col-form-label-sm">Ingrese escuela a crear:</label>
                        <input type="text" class="form-control form-control-sm" id="escuela" placeholder="Escuela"
                               required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light btn-sm" type="button" data-dismiss="modal">Cancelar</button>
                <button class="btn btn-primary btn-sm">Guardar</button>
            </div>
        </div>
    </div>
</div>


<?php
require_once "app/components/downpart.php";
?>
<script src="public/js/datatable.js"></script>