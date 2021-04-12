<?php
require_once 'dirs.php';
require_once UTIL_PATH . "sessions/SessionStarted.php";
session_start();
(new SessionStarted())->verifySessionStarted();
require_once COMPONENT_PATH . "upperpart.php";
?>


    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="mb-4">
            <h2 class="mb-0 text-gray-800">Procesos de admisión</h2>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col col-sm-12 col-md-12 col-lg-4 mb-2">
                        <button type="button" class="btn btn-primary my-2" data-toggle="modal"
                                data-target="#process_modal" id="new-process">
                            <i class="fas fa-plus"></i> Agregar proceso
                        </button>

                        <div class="alert alert-info my-3" role="alert">
                            <label for="lastProcess">Ultimo Proceso de Admision registrado</label>
                            <h3 class="font-weight-bold text-primary" id="lastProcess"
                                aria-describedby="help">
                                Cargando...
                            </h3>
                        </div>

                    </div>
                    <div class="col col-sm-12 col-md-12 col-lg-8">
                        <table id="table-process" class="table table-sm">
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

    <script src="public/js/components/Card.js"></script>
    <script src="public/js/components/Table.js"></script>
    <script src="public/js/components/Button.js"></script>
    <script src="public/js/process.js"></script>
<?php
require_once COMPONENT_PATH . "downpart.php";
?>