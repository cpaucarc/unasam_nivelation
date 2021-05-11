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
                    <div class="col col-12 col-lg-4 mb-2">
                        <button type="button" class="btn btn-primary btn-sm my-2" data-toggle="modal"
                                data-target="#courses_modal" id="new-course">
                            <i class="bi bi-plus mr-2"></i>Agregar curso
                        </button>

                        <div class="alert alert-info my-2 p-2" role="alert">
                            <div class="row">
                                <div class="col col-1 col-lg-2">
                                    <h3>
                                        <i class="bi bi-info-circle-fill"></i>
                                    </h3>
                                </div>
                                <div class="col col-11 col-lg-10">
                                    <small>
                                        Para relacionar un <strong>curso</strong> a una <strong>área</strong> dirijase
                                        <a href="areas">aqui</a>.
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col col-12 col-lg-8 mt-2">
                        <table id="table-courses" class="table table-bordered table-sm text-left">
                            <thead class="thead-light">
                            <tr>
                                <th style="width: 8%"><small><strong>N°</strong></small></th>
                                <th style="width: 50%"><small><strong>Curso</strong></small></th>
                                <th style="width: 35%"><small><strong>Dimensión</strong></small></th>
                                <th style="width: 7%"><small><strong>&nbsp;</strong></small></th>
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

    <div class="modal fade" id="courses_modal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="form-course">
                    <div class="modal-body">
                        <input type="hidden" value="0" name="procID" id="procID">
                        <div class="row">
                            <div class="col col-8">
                                <div class="form-group">
                                    <label for="dimension" class="col-form-label col-form-label-sm">Dimensión:</label>
                                    <select name="dimension" id="dimension" class="form-control form-control-sm"
                                            required></select>
                                </div>
                            </div>
                            <div class="col col-4 d-flex justify-content-end align-items-center">
                                <button type="button" class="btn btn-light btn-sm mt-2 py-2 text-dark"
                                        data-toggle="modal"
                                        data-target="#modal-dimension">
                                    <i class="bi bi-plus mr-2"></i>Nueva dimensión
                                </button>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" value="0" id="courseID" name="courseID">
                            <label for="course" class="col-form-label col-form-label-sm">Nombre del curso:</label>
                            <input name="course" type="text" class="form-control form-control-sm" id="course" value=""
                                   placeholder="Curso..." required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-light btn-sm" type="button" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Dimensions -->
    <div class="modal fade" id="modal-dimension" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form-dimension">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="dimension" class="col-form-label col-form-label-sm">Nueva Dimensión:</label>
                            <input type="text" id="dimension" name="dimension" class="form-control form-control-sm"
                                   placeholder="Dimension..."
                                   required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary btn-sm">Guardar Dimensión</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="public/js/components/SweetAlerts.js"></script>
    <script src="public/js/components/Card.js"></script>
    <script src="public/js/components/Table.js"></script>
    <script src="public/js/components/Button.js"></script>
    <script src="public/js/courses.js"></script>
<?php
require_once COMPONENT_PATH . "downpart.php";
?>