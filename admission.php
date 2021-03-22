<?php
session_start();
require_once "app/components/upperpart.php";
?>


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="mb-4">
            <h2 class="mb-0 text-gray-800">Procesos de admisión</h2>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col col-sm-12 col-md-4">
                        <button type="button" class="btn btn-primary my-2" data-toggle="modal"
                                data-target="#process_modal" id="new-process">
                            <i class="fas fa-plus"></i> Agregar proceso
                        </button>
                    </div>
                    <div class="col col-sm-12 col-md-8">
                        <table id="table-process" class="table">
                            <thead class="thead-light">
                            <tr class="text-center">
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody id="tbody" class="text-center">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="process_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form id="form">
                        <input type="hidden" value="0" name="procID" id="procID">
                        <div class="form-group">
                            <label for="proceso" class="col-form-label-sm text-uppercase">Admisión:</label>
                            <input name="denomination" type="text" class="form-control" id="denomination"
                                   placeholder="Proceso de admisión">
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary">Guardar</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!--<script src="public/js/datatable.js"></script>-->
    <script src="public/js/components/Card.js"></script>
    <script src="public/js/components/Table.js"></script>
    <script src="public/js/components/Button.js"></script>
    <script src="public/js/process.js"></script>
    <!--    <script src="public/js/datatable.js"></script>-->
<?php
require_once "app/components/downpart.php";
?>