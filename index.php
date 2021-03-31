<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(UTIL_PATH . "sessions/SessionStarted.php");
session_start();
(new SessionStarted())->verifySessionStarted();
?>

<?php
require_once "app/components/upperpart.php";
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">


        <div class="card mb-2">
            <div class="card-body">
                <div class="row">
                    <div class="col col-sm-12 col-md-9 mb-2">
                        <label for="lastProcess">Proceso de Admision</label>
                        <h3 class="font-weight-bold text-primary" id="lastProcess"
                            aria-describedby="help">
                            Cargando...
                        </h3>
                        <small id="help" class="form-text text-muted">
                            Los datos que cargue ahora se guardaran para este proceso de admisión.
                            Puede añadir un nuevo proceso entrando a <a
                                    href="http://localhost/nivelation/admision">esta pagina</a>
                        </small>
                    </div>
                    <div class="col col-sm-12 col-md-3 my-auto mx-auto">
                        <button class="btn btn-primary btn-lg" data-toggle="modal"
                                data-target="#file_modal">
                            <i class="fas fa-upload fa-sm text-white-50"></i> Subir documento
                        </button>
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
                <form id="upload_form">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="file">Adjunto</label>
                            <input type="file" class="form-control-file" name="file" id="file" required>
                        </div>
                        <div class="form-group">

                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated " role="progressbar"
                                     id="barra_estado">afsdfasfsafasd
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-sm" id="btn_cancelar" data-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary btn-sm" id="btn_upload">Subir este archivo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="public/js/datatable.js"></script>
    <!--    <script src="public/js/UploadFile.js"></script>-->
    <script src="public/js/index.js"></script>

<?php
require_once "app/components/downpart.php";
?>