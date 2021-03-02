<?php
require_once "app/views/upperpart.php";
?>


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Areas</h1>
    </div>

    <!--Ejemplo tabla con DataTables-->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <!-- Area -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 ">
                            <div class="card-header text-center">
                                <div class="text-md font-weight-bold text-primary text-uppercase">
                                    Área (<span class="badge bg-primary text-light">A</span>)</div>
                            </div>
                            <div class="card-body text-center">
                                <a href="#" class="btn btn-primary">Ver area</a>
                            </div>
                        </div>
                    </div>
                    <!-- Area -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 ">
                            <div class="card-header text-center">
                                <div class="text-md font-weight-bold text-primary text-uppercase">
                                    Área (<span class="badge bg-primary text-light">B</span>)</div>
                            </div>
                            <div class="card-body text-center">
                                <a href="#" class="btn btn-primary">Ver area</a>
                            </div>
                        </div>
                    </div>
                    <!-- Area -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 ">
                            <div class="card-header text-center">
                                <div class="text-md font-weight-bold text-primary text-uppercase">
                                    Área (<span class="badge bg-primary text-light">C</span>)</div>
                            </div>
                            <div class="card-body text-center">
                                <a href="areainschool.php" class="btn btn-primary">Ver area</a>
                            </div>
                        </div>
                    </div>
                    <!-- Area -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 ">
                            <div class="card-header text-center">
                                <div class="text-md font-weight-bold text-primary text-uppercase">
                                    Crear
                                </div>
                            </div>
                            <div class="card-body text-center">
                                <a href="#" class="link-add-card text-secondary" data-toggle="modal" data-target="#add-area"> <i class="fas fa-plus-circle"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->



<!-- Logout Modal-->
<div class="modal fade" id="add-area" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear nueva área</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="area" class="col-form-label-sm text-uppercase">Ingrese area a crear:</label>
                        <input type="text" class="form-control form-control-user" id="area" placeholder="Area">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                <button class="btn btn-primary" >Guardar</button>
            </div>
        </div>
    </div>
</div>

<?php
require_once "app/views/downpart.php";
?>