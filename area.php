<?php
require_once "app/components/upperpart.php";
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
                <div id="listAreas"></div>
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
<script src="public/js/area.js"></script>
<?php
require_once "app/components/downpart.php";
?>