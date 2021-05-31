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
                        <?php if (intval($_SESSION['user_logged']['utid']) === 1) { ?>
                            <button type="button" class="btn btn-primary btn-sm my-2" data-toggle="modal"
                                    data-target="#process_modal" id="new-process">
                                <i class="bi bi-plus mr-2"></i>Agregar proceso
                            </button>
                        <?php } ?>
                        <div class="alert alert-info my-3" role="alert">
                            <label for="lastProcess" class="col-form-label col-form-label-sm">Ultimo Proceso de Admision
                                registrado</label>
                            <h3 class="font-weight-bold text-primary" aria-describedby="help">
                                <i class="bi bi-calendar-check mr-2"></i> <span id="lastProcess">Cargando...</span>
                            </h3>
                        </div>

                    </div>
                    <div class="col col-12 col-lg-8 mt-2">
                        <div class="table-responsive">
                            <table id="table-process" class="table table-sm table-striped border">
                                <thead class="thead-light">
                                <tr class="text-center">
                                    <th><small><strong>N°</strong></small></th>
                                    <th><small><strong>Proceso</strong></small></th>
                                    <th><small><strong>Porc. Mínimo<sup> 1 </sup></strong></small></th>
                                    <th><small><strong>Nota Mínima<sup> 2 </sup></strong></small></th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody id="tbody" class="text-center">
                                </tbody>
                            </table>
                        </div>

                        <div class="alert alert-light mt-3">
                            <small> Nota:</small>
                            <ol>
                                <li>
                                    <small>
                                        Los estudiantes con puntaje menor al Porcentaje mínimo requeriran de
                                        nivelación
                                        obligatoria.
                                    </small>
                                </li>
                                <li>
                                    <small>
                                        Los estudiantes deberan obtener una calificación final mayor a la nota
                                        mínima en
                                        el program de nivelación.
                                    </small>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php if (intval($_SESSION['user_logged']['utid']) === 1) { ?>
    <div class="modal fade" data-backdrop="static" id="process_modal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="form">
                    <div class="modal-body">
                        <input type="hidden" value="0" name="procID" id="procID">

                        <div class="form-group row">
                            <label for="denomination" class="col-4 col-form-label col-form-label-sm text-right">Proceso
                                de Admisión:</label>
                            <div class="col-8">
                                <input name="denomination" type="text" class="form-control form-control-sm"
                                       id="denomination" placeholder="Ej. 2019-I" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="minPercent" class="col-4 col-form-label col-form-label-sm text-right">Porcentaje
                                Minimo:</label>
                            <div class="col-8">
                                <input name="minPercent" type="number" class="form-control form-control-sm"
                                       id="minPercent" value="30" min="0" max="100" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="minQlf" class="col-4 col-form-label col-form-label-sm text-right">Nota
                                Minimo:</label>
                            <div class="col-8">
                                <input name="minQlf" type="number" class="form-control form-control-sm"
                                       id="minQlf" required value="14" min="0" max="20">
                            </div>
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
<?php } ?>

    <script src="public/js/components/SweetAlerts.js"></script>
    <script src="public/js/components/Card.js"></script>
    <script src="public/js/components/Table.js"></script>
    <script src="public/js/components/Button.js"></script>
    <script src="public/js/process.js"></script>
<?php
require_once COMPONENT_PATH . "downpart.php";
?>