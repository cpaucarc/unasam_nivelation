<?php
require_once 'dirs.php';
require_once UTIL_PATH . "sessions/SessionStarted.php";
session_start();
$sessionStarted = new SessionStarted();
$sessionStarted->verifySessionStarted();

require_once $sessionStarted->getUpperPartByUserType();
if (intval($_SESSION['user_logged']['utid']) === 5) {
    ?>
    <!-- Begin Page Content -->
    <div class="container">
        <div class="form-group">
            <input type="hidden" class="form-control form-control-sm" id="directorID"
                   name="directorID" value="<?php echo $_SESSION['user_logged']['id']; ?>" readonly required>
            <input type="hidden" class="form-control form-control-sm" id="programID"
                   name="programID" value="0" readonly required>
        </div>


        <div class="card">
            <div class="card-body">
                <div class="card-title mb-4">
                    <div class="d-flex justify-content-between mb-3">
                        <h4>Cursos del programa academico</h4>
                        <div class="form-group form-inline">
                            <label for="process" class="col-form-label-sm mb-0 pb-0 mr-1">Proceso de admisión</label>
                            <select class="form-control form-control-sm" id="process" name="process">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row" id="list-courses">
                    <div class="d-flex justify-content-center mx-auto align-items-center">
                        <div class="bd-highlight w-50 mx-auto text-center">
                            <img src="public/images/options.svg" class="w-50 mb-3" alt="No hay cursos">
                            <h4>Seleccione el proceso de admisión</h4>
                            <small class="text-muted">
                                Seleccione en la parte superior el proceso de admision del cual desea ver los cursos.
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalTracing" data-backdrop="static" data-keyboard="false" tabindex="-1"
         aria-labelledby="modalTracing" aria-hidden="true">
        <div class="modal-dialog modal-xl shadow-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">
                        Seguimiento de Asistencias
                    </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6>Estudiantes:</h6>
                    <div class="table-responsive">
                        <table class="table table-sm table-striped border">
                            <thead class="thead-light">
                            <tr>
                                <th><small><strong>N°</strong></small></th>
                                <th><small><strong>Código</strong></small></th>
                                <th><small><strong>Estudiante</strong></small></th>
                                <th><small><strong>Teléfono</strong></small></th>
                                <th><small><strong>Correo</strong></small></th>
                                <th><small><strong>Dirreccion</strong></small></th>
                                <th><small><strong>Asistencia</strong></small></th>
                            </tr>
                            </thead>
                            <tbody id="tbody-students">
                            </tbody>
                        </table>
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
                        <div class="col col-12 text-dark">
                            <ul>
                                <li><small id="infoGroup"></small></li>
                                <li><small>Curso: <span id="infoCourse"></span></small></li>
                                <li><small>Docente: <span id="infoTeacher"></span></small></li>
                                <li><small>Area: <span id="infoArea"></span></small></li>
                                <li><small>Inicio: <span id="infoDateStart"></span></small></li>
                                <li><small>Fin: <span id="infoDateEnd"></span></small></li>
                            </ul>
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

    <script src="public/js/components/Select.js"></script>
    <script src="public/js/components/SweetAlerts.js"></script>
    <script src="public/js/components/Badge.js"></script>
    <script src="public/js/components/Table.js"></script>
    <script src="public/js/components/Button.js"></script>
    <script src="public/js/components/Card.js"></script>
    <script src="public/js/tracing.js"></script>

    <?php
    require_once COMPONENT_PATH . "downpart.php";
} else {
    echo '<h2 class="text-center">Usted no esta autorizado para ver esta pagina</h2>';
}
?>