<?php
require_once "app/views/upperpart.php";
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
    </div>

    <!--Ejemplo tabla con DataTables-->
    <div class="container">

        <div class="row">
            <!-- Default Card Example -->
            <div class="card mb-4 w-100">
                <div class="card-header">
                    <h5>Agregar escuelas</h5>
                </div>
                <div class="card-body ">
                    <form action="" class="d-sm-flex align-items-center justify-content-between mb-4">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="email" class="form-control " placeholder="Escuela">
                        </div>
                        <div class="col-sm-6 mb-3 mb-sm-0 text-right">
                            <button class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Puesto</th>
                                            <th>Ciudad</th>
                                            <th>Edad</th>
                                            <th>Año de Ingreso</th>
                                            <th>Salario</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Tiger Nixon</td>
                                            <td>Arquitecto</td>
                                            <td>Edinburgh</td>
                                            <td>61</td>
                                            <td>2011/04/25</td>
                                            <td>$320,800</td>
                                        </tr>
                                        <tr>
                                            <td>Garrett Winters</td>
                                            <td>Contador</td>
                                            <td>Tokyo</td>
                                            <td>63</td>
                                            <td>2011/07/25</td>
                                            <td>$170,750</td>
                                        </tr>
                                        <tr>
                                            <td>Cedric Kelly</td>
                                            <td>Senior Javascript Developer</td>
                                            <td>Edinburgh</td>
                                            <td>22</td>
                                            <td>2012/03/29</td>
                                            <td>$433,060</td>
                                        </tr>
                                        <tr>
                                            <td>Airi Satou</td>
                                            <td>Contador</td>
                                            <td>Tokyo</td>
                                            <td>33</td>
                                            <td>2008/11/28</td>
                                            <td>$162,700</td>
                                        </tr>
                                    </tbody>
                                </table>
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
                <button class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>

<?php
require_once "app/views/downpart.php";
?>