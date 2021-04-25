<?php
require_once 'dirs.php';
require_once UTIL_PATH . "sessions/SessionStarted.php";
session_start();
(new SessionStarted())->verifySessionStarted();
require_once COMPONENT_PATH . "upperpart.php";
?>
    <!-- Begin Page Content -->
    <div class="container">

        <div class="card">
            <div class="card-body">
                <div class="row d-flex justify-content-between">
                    <div class="col col-12 col-lg-4 mb-2">
                        <button type="button" class="btn btn-primary my-2" data-toggle="modal"
                                data-target="#courses_modal" id="new-course">
                            <i class="fas fa-plus"></i> Agregar curso
                        </button>

                        <div class="alert alert-info my-3" role="alert">
                            <div class="row">

                                <div class="col col-1 col-lg-2">
                                    <i class="fa fa-info-circle fa-2x" aria-hidden="true"></i>
                                </div>
                                <div class="col col-11 col-lg-10">
                                    <p>
                                        Para relacionar un <strong>curso</strong> a una <strong>área</strong> dirijase
                                        <a href="areas">aqui</a>.
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col col-12 col-lg-8 mt-2">
                        <table id="table-courses" class="table table-bordered table-sm text-left">
                            <thead class="thead-light">
                            <tr>
                                <th style="width: 8%">N°</th>
                                <th style="width: 50%">Curso</th>
                                <th style="width: 35%">Dimensión</th>
                                <th style="width: 7%">&nbsp;</th>
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
                <div class="modal-body">
                    <form id="form-course">
                        <input type="hidden" value="0" name="procID" id="procID">
                        <div class="row">
                            <div class="col col-9">
                                <div class="form-group">
                                    <label for="dimension" class="col-form-label-sm">Dimensión:</label>
                                    <select name="dimension" id="dimension" class="form-control" required></select>
                                </div>
                            </div>
                            <div class="col col-3 d-flex justify-content-end align-items-center">
                                <button type="button" class="btn btn-light btn-sm mt-3 text-dark"
                                        data-toggle="modal"
                                        data-target="#modal-dimension">
                                    <i class="fas fa-plus"></i> Nuevo
                                </button>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" value="0" id="courseID" name="courseID">
                            <label for="course" class="col-form-label-sm">Nombre del curso:</label>
                            <input name="course" type="text" class="form-control" id="course"
                                   placeholder="Curso..." required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
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
                            <label class="col-form-label-sm">Nueva Dimensión:</label>
                            <input type="text" name="dimension" class="form-control" placeholder="Dimension..."
                                   required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar Dimensión</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="public/js/components/Card.js"></script>
    <script src="public/js/components/Table.js"></script>
    <script src="public/js/components/Button.js"></script>
    <script src="public/js/courses.js"></script>
<?php
require_once COMPONENT_PATH . "downpart.php";
?>