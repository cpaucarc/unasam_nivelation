<?php
require_once 'dirs.php';
require_once UTIL_PATH . "sessions/SessionStarted.php";
session_start();
$sessionStarted = new SessionStarted();
$sessionStarted->verifySessionStarted();

require_once $sessionStarted->getUpperPartByUserType();
if (intval($_SESSION['user_logged']['utid']) === 4) {
    ?>
    <!-- Begin Page Content -->


    <div class="container">
        <div class="form-group">
            <input type="hidden" class="form-control form-control-sm" id="teacherID"
                   name="teacherID" value="<?php echo $_SESSION['user_logged']['id']; ?>" readonly required>
        </div>


        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">
                    Mis cursos
                </h4>
                <div class="row" id="list-courses">
                    <div class="d-flex justify-content-center mx-auto align-items-center">
                        <div class="bd-highlight w-50 mx-auto text-center">
                            <img src="public/images/no_data.svg" class="w-50 mb-3" alt="No hay cursos">
                            <h4>No hay ningun curso</h4>
                            <p class="text-muted">
                                No se le asignado ningun curso para este proceso de nivelación
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalAttendance" data-backdrop="static" data-keyboard="false" tabindex="-1"
         aria-labelledby="modalAttendance" aria-hidden="true">
        <div class="modal-dialog modal-lg shadow-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">
                        Registro de asistencia:
                        <span id="courseNameTitle" class="font-weight-bold text-primary"></span>
                        - <span id="groupNameTitle"></span>
                        del Area <span id="areaNameTitle"></span>
                    </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formClassData">
                        <div class="row">
                            <div class="col col-12 col-md-8 mb-3">
                                <input type="hidden" id="groupID" name="groupID" value="0" readonly required>
                                <input type="hidden" id="classDataID" name="classDataID" value="0" readonly required>
                                <div class="form-group row">
                                    <label for="topic" class="col-md-3 col-form-label col-form-label-sm">
                                        Tema de la clase:
                                    </label>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control form-control-sm" id="topic" name="topic"
                                               required>
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-primary btn-sm" type="submit">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="d-none" id="tableStudentsOfGroup">
                        <div class="row">
                            <div class="col col-8 mb-3">
                                <h6>Estudiantes:</h6>
                                <div class="table-responsive">
                                    <table class="table table-sm table-striped border">
                                        <tbody id="tbody-students">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col col-4 mb-3">
                                <h6>Resumen:</h6>
                                <table class="table table-borderless table-sm">
                                    <tbody>
                                    <tr>
                                        <td><small>&nbsp;</small></td>
                                        <td class="text-success">
                                            <small><strong>Presentes</strong></small>
                                        </td>
                                        <td><small id="std-present">0</small></td>
                                        <td><small id="std-present-pct">0</small></td>
                                    </tr>
                                    <tr>
                                        <td><small>&nbsp;</small></td>
                                        <td class="text-danger">
                                            <small><strong>Ausentes</strong></small>
                                        </td>
                                        <td><small id="std-absent">0</small></td>
                                        <td><small id="std-absent-pct">0</small></td>
                                    </tr>
                                    <tr>
                                        <td><small>&nbsp;</small></td>
                                        <td><small><strong>Total</strong></small></td>
                                        <td><small id="std-total">0</small></td>
                                        <td><small>100%</small></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalInfoClass" data-backdrop="static" data-keyboard="false" tabindex="-1"
         aria-labelledby="modalInfoClass" aria-hidden="true">
        <div class="modal-dialog modal-md shadow-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">
                        Datos de la clase:
                    </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="infoGroupID" value="0" readonly>
                    <div class="row mb-4">
                        <div class="col col-5 text-dark">
                            <small>
                                <ul>
                                    <li><span id="infoGroup"></span></li>
                                    <li><span>Curso: <span id="infoCourse"></span></span></li>
                                    <li><span>Area: <span id="infoArea"></span></span></li>
                                </ul>
                            </small>

                        </div>
                        <div class="col col-4 text-muted text-left">
                            <small>N° de Estudiantes</small>
                            <h4 id="infoNumStd" class="text-dark"></h4>
                        </div>
                        <div class="col col-3 text-muted text-left">
                            <button type="button" class="btn btn-light btn-sm" data-toggle="modal"
                                    data-target="#modalStdsQlf" id="createQualifications">
                                Ingresar notas
                            </button>
                        </div>
                    </div>
                    <h6>Horario:</h6>
                    <table class="table table-sm table-striped border">
                        <thead>
                        <tr>
                            <th><small><strong>N°</strong></small></th>
                            <th><small><strong>Dia</strong></small></th>
                            <th><small><strong>Inicio</strong></small></th>
                            <th><small><strong>Fin</strong></small></th>
                            <th><small><strong>Salón</strong></small></th>
                        </tr>
                        </thead>
                        <tbody id="tbody-schedule">
                        <tr>
                            <td colspan="5"><small class="text-center">No hay horarios</small></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Students for Qualications-->
    <div class="modal fade" id="modalStdsQlf" data-backdrop="static" tabindex="-1" aria-labelledby="modalStdsQlf"
         aria-hidden="true">
        <div class="modal-dialog shadow-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Calificación final de los estudiantes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pt-0">
                    <div class="alert alert-light py-1 mb-4 text-muted" role="alert">
                        <small>
                            Las calificaciones que se ingresen representan la nota final del estudiante en el curso.
                            Este proceso solo debe hacerse al final del curso.
                            <strong>La nota minima para aprobar es de 14 [Art. 6-j]</strong>
                        </small>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-sm table-striped border">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col"><small><strong>N°</strong></small></th>
                                <th scope="col"><small><strong>Estudiante</strong></small></th>
                                <th scope="col"><small><strong>Calificación</strong></small></th>
                                <th scope="col"><small><strong>Condición</strong></small></th>
                                <th scope="col"><small><strong>&nbsp;</strong></small></th>
                            </tr>
                            </thead>
                            <tbody id="tbody-std-qlf">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal For  Change Qualication Of Student-->
    <div class="modal fade" id="modalChangeQlf" data-backdrop="static" tabindex="-1" aria-labelledby="modalStdsQlf"
         aria-hidden="true">
        <div class="modal-dialog shadow-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Cambiar calificación de <span class="text-primary" id="changeStdName"></span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formChangeQlf">
                    <div class="modal-body">
                        <input type="hidden" id="changeQlfID" name="changeQlfID" readonly required>

                        <div class="form-group row">
                            <label for="currentQlf" class="col-md-3 col-form-label col-form-label-sm">
                                Calificación:
                            </label>
                            <div class="col-md-7">
                                <input type="number" class="form-control form-control-sm" id="currentQlf"
                                       name="currentQlf" min="0" max="20" step="1" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary btn-sm">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="public/js/components/SweetAlerts.js"></script>
    <script src="public/js/components/Badge.js"></script>
    <script src="public/js/components/Table.js"></script>
    <script src="public/js/components/Button.js"></script>
    <script src="public/js/components/Card.js"></script>
    <script src="public/js/my_courses.js"></script>

    <?php
    require_once COMPONENT_PATH . "downpart.php";
} else {
    echo '<h2 class="text-center">Usted no esta autorizado para ver esta pagina</h2>';
}

?>