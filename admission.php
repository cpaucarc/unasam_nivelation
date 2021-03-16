<?php
require_once "app/components/upperpart.php";
?>


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#school_modal">
            <i class="fas fa-plus"></i> Nuevo proceso
        </button>
    </div>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Proceso de admisión</h6>
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
                            <td>2020-I</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button class="btn btn-warning btnEditar" data-toggle="modal" data-target="#school_modal"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-danger btnEliminar"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>2020-II</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button class="btn btn-warning btnEditar" data-toggle="modal" data-target="#school_modal"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-danger btnEliminar"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>2020-I</td>
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
                <h5 class="modal-title" id="exampleModalLabel">Agregar curso</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="proceso" class="col-form-label-sm text-uppercase">Adminisión:</label>
                        <input type="text" class="form-control " id="proceso" placeholder="Proceso de admisión">
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

<script src="public/js/datatable.js"></script>
<?php
require_once "app/components/downpart.php";
?>