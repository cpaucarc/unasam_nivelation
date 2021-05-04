<?php
require_once 'dirs.php';
require_once UTIL_PATH . "sessions/SessionStarted.php";
session_start();
$sessionStarted = new SessionStarted();
$sessionStarted->verifySessionStarted();

require_once $sessionStarted->getUpperPartByUserType();
?>


    <!-- Begin Page Content -->
    <div class="container">

        <div class="card">
            <div class="card-body">
                <div class="row d-flex justify-content-between">
                    <div class="col col-12 col-lg-3 mb-3">
                        <button type="button" class="btn btn-primary btn-sm my-2" data-toggle="modal"
                                data-target="#process_modal" id="new-process">
                            <i class="bi bi-plus mr-2"></i>Agregar proceso
                        </button>

                        <div class="alert alert-info my-3" role="alert">
                            <label for="lastProcess" class="col-form-label col-form-label-sm">Ultimo Proceso de Admision registrado</label>
                            <h3 class="font-weight-bold text-primary" aria-describedby="help">
                                <i class="bi bi-calendar-check mr-2"></i> <span id="lastProcess">Cargando...</span>
                            </h3>
                        </div>

                    </div>
                    <div class="col col-12 col-lg-8">
                        <table id="table-process" class="table table-sm table-bordered">
                            <thead class="thead-light">
                            <tr class="text-center">
                                <th>#</th>
                                <th>Nombre</th>
                                <th>&nbsp;</th>
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

    <div class="modal fade" data-backdrop="static" id="process_modal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form id="form">
                        <input type="text" value="0" name="procID" id="procID">
                        <div class="form-group">
                            <label for="proceso" class="col-form-label col-form-label-sm">Admisión:</label>
                            <input name="denomination" type="text" class="form-control form-control-sm" id="denomination" required
                                   placeholder="Proceso de admisión">
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light btn-sm" type="button" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary btn-sm">Guardar</button>
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