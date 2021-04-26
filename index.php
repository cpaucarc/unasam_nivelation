<?php
require_once 'dirs.php';
require_once UTIL_PATH . "sessions/SessionStarted.php";
session_start();
$sessionStarted = new SessionStarted();
$sessionStarted->verifySessionStarted();

require_once $sessionStarted->getUpperPartByUserType();
?>

    <div class="container-fluid">

        <div class="row d-flex justify-content-center">
            <div class="col-9">
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="row d-flex justify-content-between">
                            <div class="col col-12 col-lg-7 mb-4">
                                <label for="lastProcess">Proceso de Admision</label>
                                <h3 class="font-weight-bold text-primary" aria-describedby="help">
                                    <i class="fas fa-calendar-day"></i> <span id="lastProcess">Cargando...</span>
                                </h3>
                                <small id="help" class="form-text text-muted">
                                    Los datos que cargue ahora se guardaran para este proceso de admisión.
                                    Puede añadir un nuevo proceso entrando a <a href="admision">esta pagina</a>
                                </small>
                            </div>
                            <div class="col col-12 col-lg-4 my-auto">
                                <button class="btn btn-primary btn-lg" data-toggle="modal"
                                        data-target="#file_modal">
                                    <i class="fas fa-upload fa-sm text-white-50"></i> Subir documento
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="file_modal" data-backdrop="static" data-keyboard="false" tabindex="-1"
         aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Selector de archivos</h5>
                    <button type="button" class="close" id="cerrar_barra" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="upload_form" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="file">Adjunto</label>
                            <input type="file" class="form-control-file" name="file" id="file" required>
                        </div>
                        <div class="form-group">

                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated " role="progressbar"
                                     id="barra_estado">barra de estado
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-sm" id="btn_cancelar" data-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary btn-sm" id="btn_upload">
                            Subir este archivo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--    <script src="public/js/datatable.js"></script>-->
    <!--    <script src="public/js/UploadFile.js"></script>-->
    <script src="public/js/index.js"></script>

<?php
@include_once "app/components/downpart.php";
?>