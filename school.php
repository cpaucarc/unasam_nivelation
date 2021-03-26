<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(UTIL_PATH . "sessions/SessionStarted.php");
session_start();
(new SessionStarted())->verifySessionStarted();
require_once "app/components/upperpart.php";
?>


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="card border-left-primary shadow h-100 ">
            <div class="card-body">
                <div class="text-md font-weight-bold text-primary text-uppercase">
                    Grupo (<span class="area">A</span>)</div>
            </div>
        </div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#school_modal">
            <i class="fas fa-plus"></i> Nuevo escuela
        </button>
    </div>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Escuelas</h6>
        </div>
        <div class="card-body ">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
                                    <button class="btn btn-warning btnEditar" data-toggle="modal" data-target="#school_modal"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-danger btnEliminar"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Ingeniería de Civil</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button class="btn btn-warning btnEditar" data-toggle="modal" data-target="#school_modal"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-danger btnEliminar"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Ingeniería de Industrial</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button class="btn btn-warning btnEditar" data-toggle="modal" data-target="#school_modal"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-danger btnEliminar"><i class="fas fa-trash-alt"></i></button>
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
<div class="modal fade" id="school_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar nueva escuela</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="escuela" class="col-form-label-sm text-uppercase">Ingrese escuela a crear:</label>
                        <input type="text" class="form-control" id="escuela" placeholder="Escuela">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                <button class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>


<?php
require_once "app/components/downpart.php";
?>
<script src="public/js/datatable.js"></script>