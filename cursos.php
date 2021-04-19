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
                                <div class="col col-2 col-md-3">
                                    <i class="fa fa-info-circle fa-2x" aria-hidden="true"></i>
                                </div>
                                <div class="col col-10 col-md-9">
                                    <p>
                                        Para añadir un curso a una area dirijase
                                        <a href="areas">aqui</a>.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col col-12 col-lg-7 mt-2">
                        <table id="table-courses" class="table table-bordered table-sm text-left">
                            <thead class="thead-light">
                            <tr>
                                <th style="width: 10%;">N°</th>
                                <th style="width: 80%;">Cursos</th>
                                <th style="width: 10%;">&nbsp;</th>
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

    <div class="modal fade" data-backdrop="static" id="courses_modal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form id="form-course">
                        <input type="hidden" value="0" name="procID" id="procID">
                        <div class="form-group">
                            <input type="hidden" value="0" id="courseID" name="courseID">
                            <label for="course" class="col-form-label-sm">Nombre del curso:</label>
                            <input name="course" type="text" class="form-control" id="course"
                                   placeholder="Curso...">
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

    <script src="public/js/components/Card.js"></script>
    <script src="public/js/components/Table.js"></script>
    <script src="public/js/components/Button.js"></script>
    <script src="public/js/courses.js"></script>
<?php
require_once COMPONENT_PATH . "downpart.php";
?>