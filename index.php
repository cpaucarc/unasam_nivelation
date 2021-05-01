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
                        <div class="row d-flex justify-content-around">
                            <div class="col col-12 col-lg-7 mb-4">
                                <label for="lastProcess">Proceso de Admision</label>
                                <h3 class="font-weight-bold text-primary" aria-describedby="help">
                                    <i class="bi bi-calendar-check mr-2"></i> <span id="lastProcess">Cargando...</span>
                                </h3>
                                <small id="help" class="form-text text-muted">
                                    Los datos que cargue ahora se guardaran para este proceso de admisión.
                                    Puede añadir un nuevo proceso entrando a <a href="admision">esta pagina</a>
                                </small>
                            </div>
                            <div class="col col-12 col-lg-4 my-auto">
                                <button class="btn btn-primary btn-block" data-toggle="modal"
                                        data-target="#file_modal">
                                    <i class="bi bi-upload mr-2"></i>Subir documento
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <a class="btn btn-light btn-sm" data-toggle="collapse" href="#collapseExample"
                       role="button"
                       aria-expanded="false" aria-controls="collapseExample">
                        <i class="bi bi-emoji-frown text-danger"></i> <span>Ver pasos faltantes</span>
                    </a>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </br>
                </div>
                <div class="modal-body pt-0">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <div class="collapse mt-2" id="collapseExample">
                                <div class="card card-body">
                                    <small>
                                        <ul class="mb-0 pl-3">
                                            <li>Falta rangos minimo y recomendado para los cursos Algebra, Fisica,
                                                Quimica
                                                del Area A
                                            </li>
                                            <li>Falta rangos minimo y recomendado para los cursos Lenguaje, Fisica,
                                                Quimica
                                                del Area B
                                            </li>
                                            <li>Falta rangos minimo y recomendado para los cursos Lenguaje, Cultura
                                                General,
                                                Quimica del Area B
                                            </li>
                                        </ul>
                                    </small>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div id="file-form" class="col-12">
                            <form id="upload_form" enctype="multipart/form-data">
                                <div class="col-12">
                                    <div class="row border p-2 d-flex align-items-end">
                                        <div class="col-1 d-flex justify-content-center">
                                            <h2 class="mb-4" id="file-icon">
                                                <i class="bi bi-question-square"></i>
                                            </h2>
                                        </div>
                                        <div class="col-11">
                                            <div class="form-group">
                                                <label for="file" class="mb-1">Adjunto</label>
                                                <input type="file" class="form-control-file" name="file" id="file"
                                                       accept=".xls, .xlsx" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end my-3 pr-0">
                                    <span id="ruta">Ver ruta</span>
                                    <button type="button" class="btn btn-light btn-sm mr-2" data-toggle="modal"
                                            data-target="#exampleModal" id="preview" disabled>
                                        <i class="bi bi-table mr-2"></i>Vista previa
                                    </button>
                                    <button type="submit" class="btn btn-primary btn-sm" id="btn_upload" disabled>
                                        <i class="bi bi-server"></i>Guardar y clasificar datos
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="alert alert-info mb-0 w-100" role="alert">
                        <small class="mb-0">
                            Verifique que los datos que se muestran en esta vista previa se corresponde al
                            archivo de excel que desea subir. Si hubiera variaciones, modifique su archivo excel.
                        </small>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="thead-light">
                            <tr>
                                <th><small><strong>Nro</strong></small></th>
                                <th><small><strong>DNI</strong></small></th>
                                <th><small><strong>CodigoPos</strong></small></th>
                                <th><small><strong>CodigoUni</strong></small></th>
                                <th><small><strong>Apellidos</strong></small></th>
                                <th><small><strong>Nombres</strong></small></th>
                                <th><small><strong>Sexo</strong></small></th>
                            </tr>
                            </thead>
                            <tbody id="tbody">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--    <script src="public/js/datatable.js"></script>-->
    <!--    <script src="public/js/UploadFile.js"></script>-->
    <script src="public/js/index.js"></script>

<?php
@include_once "app/components/downpart.php";
?>