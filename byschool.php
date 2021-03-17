<?php
require_once "app/components/upperpart.php";
?>


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h5 mb-0 text-gray-800">Reporte por escuela</h1>
<!--         <select class="form-control form-control text-primary" id="semestre" style="width:150px">
            <option>Admisión</option>
            <option>2020-II</option>
            <option>2021-I</option>
            <option>2021-II</option>
            <option>2022-I</option>
            <option>2022-II</option>
        </select>
 -->
    </div>

    <!-- Default Card Example -->
    <div class="card mb-4 w-100">
        <div class="card-header py-3">
            <div class="input-group">
                <input list="students" class="form-control" name="txSearch" id="txSearch" />
                <datalist id="students">
                    <option value="Chrome">
                    <option value="Firefox">
                    <option value="Internet Explorer">
                    <option value="Opera">
                    <option value="Safari">
                    <option value="Microsoft Edge">
                </datalist>

                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit" id="btSearch">
                        <i class="fas fa-search "></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Tabla escuelas</h6>
            <select class="form-control text-primary" id="semestre" style="width:150px">
                <option>Admisión</option>
                <option>2020-II</option>
                <option>2021-I</option>
                <option>2021-II</option>
                <option>2022-I</option>
                <option>2022-II</option>
            </select>
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

<?php
require_once "app/components/downpart.php";
?>
<script src="public/js/datatable.js"></script>