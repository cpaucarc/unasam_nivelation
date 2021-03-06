<?php
require_once "dirs.php";
require_once UTIL_PATH . "sessions/SessionStarted.php";
session_start();
$sessionStarted = new SessionStarted();
$sessionStarted->verifySessionStarted();
$stdID = empty($_GET['std']) ? 0 : $_GET['std'];
$routeAux = empty($_GET['std']) ? "" : "../";

if (intval($_SESSION['user_logged']['utid']) === 3 and intval($_SESSION['user_logged']['id']) !== $stdID) {
    $stdID = intval($_SESSION['user_logged']['id']);
}

require_once $sessionStarted->getUpperPartByUserType();
?>
    <!-- Begin Page Content -->
    <div class="container">
        <div class="hide">
            <input type="hidden" id="stdID" class="" value="<?php echo $stdID; ?>">
        </div>

        <div class="card mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between">

                    <?php if (intval($_SESSION['user_logged']['utid']) !== 3) { ?>
                        <div class="cp-2 bd-highlight w-50">
                            <div class="input-group">
                                <input list="students" type="text" class="form-control form-control-sm"
                                       placeholder="Escribe el apellido del estudiante..." id="txSearch">
                                <div class="input-group-append" id="btSearch">
                                    <span class="input-group-text py-0 px-2 btn rounded-right">
                                        <i class="bi bi-search"></i>
                                    </span>
                                </div>
                                <datalist id="students">
                                </datalist>
                            </div>

                        </div>
                    <?php } ?>
                    <div class="ml-auto bd-highlight d-flex">
                        <div class="dropdown ml-2">
                            <a class="btn btn-light btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-graph-up mr-2"></i>Reportes y Graficos
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <h6 class="dropdown-header">Reportes</h6>
                                <a>
                                    <form action="<?php echo $routeAux; ?>reporte/estudiante" method="post"
                                          target="_blank">
                                        <input id="studentPdf" name="studentPdf" required type="hidden" value="0"
                                               readonly>
                                        <input id="byTipe" name="byTipe" required type="hidden" value="0" readonly>
                                        <button type="submit" class="dropdown-item">
                                            <i class="bi bi-person-badge mr-2"></i>Ver este alumno por <span
                                                    id="tipePdf"></span>
                                        </button>
                                    </form>
                                </a>
                                <div class="dropdown-divider"></div>
                                <h6 class="dropdown-header">Gráficos</h6>
                                <a>
                                    <form action="<?php echo $routeAux; ?>estudiante-grafico" target="_blank"
                                          method="post"
                                          class="mx-2">
                                        <input id="studentChart" name="studentChart" required type="hidden" value="0"
                                               readonly>
                                        <button type="submit" class="dropdown-item">
                                            <i class="bi bi-pie-chart-fill mr-2"></i> Ver Graficos
                                        </button>
                                    </form>
                                </a>
                            </div>

                        </div>
                    </div>
                    <div class="bd-highlight d-flex ml-2">
                        <button type="button" class="btn btn-light btn-sm" id="showSchedule" data-toggle="modal"
                                data-target="#modalSchedules">
                            Ver horario
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col col-12 col-lg-4 mb-3">
                        <div id="student-info-card">
                            <!-- Student Info Card Here-->
                        </div>
                        <div id="not-student-card">
                            <!-- Just when stdID in POST is 0 -->
                        </div>
                    </div>
                    <div class="col col-12 col-lg-8">

                        <div class="card">
                            <div class="card-header pt-1 pb-0 px-3">
                                <ul class="nav nav-tabs border-bottom-0 text-muted">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#for_dimensions_basic"
                                           id="navBasico">
                                            Análisis Básico
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#for_courses" id="navDimension">
                                            Análisis por Dimensiones
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#for_dimensions" id="navCourse">
                                            Análisis por Cursos
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <!--Panel 1-->
                                    <div class="tab-pane fade in show active" id="for_dimensions_basic" role="tabpanel">
                                        <!--Tabla-->
                                        <div class="table-responsive">
                                            <table class="table border">
                                                <thead>
                                                <tr class="text-center">
                                                    <th scope="col" class="text-left" style="width: 5%;">
                                                        <small><strong>N°</strong></small>
                                                    </th>
                                                    <th scope="col" class="text-left" style="width: 33%;">
                                                        <small><strong>Dimensión</strong></small>
                                                    </th>
                                                    <th scope="col" class="text-left">
                                                        <small><strong>Recomendación</strong></small>
                                                    </th>
                                                    <th scope="col" class="text-left">
                                                        <small>&nbsp;</small>
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody id="tbody-dimensions-basic-body">
                                                </tbody>
                                            </table>
                                            <small class="mb-3">
                                                <strong>*</strong> Este análisis está basado en el puntaje general
                                            </small>
                                        </div>
                                    </div>

                                    <!--Panel 2-->
                                    <div class="tab-pane fade" id="for_courses" role="tabpanel">
                                        <!--Tabla-->
                                        <div class="table-responsive">
                                            <table id="table-dimensions" class="table border">
                                                <thead>
                                                <tr class="text-center">
                                                    <th scope="col" class="text-left" style="width: 5%;">
                                                        <small><strong>N°</strong></small>
                                                    </th>
                                                    <th scope="col" class="text-left" style="width: 33%;">
                                                        <small><strong>Dimensión</strong></small>
                                                    </th>
                                                    <th scope="col" class="text-left" style="width: 7%;">
                                                        <small><strong>Porc*</strong></small>
                                                    </th>
                                                    <th scope="col" class="text-left">
                                                        <small><strong>Recomendación</strong></small>
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody id="table-dimensions-body">
                                                <tr>
                                                    <td colspan="4"><small>No calculado</small></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <small class="mb-3">
                                                <strong>*</strong> Representa el porcentaje de preguntas correctas
                                                dentro de la dimensión.<br>
                                                <strong>*</strong> Una dimensión es un grupo que contiene a varios
                                                cursos.
                                            </small>
                                        </div>

                                    </div>

                                    <!--Panel 3-->
                                    <div class="tab-pane fade" id="for_dimensions" role="tabpanel">
                                        <!--Tabla-->
                                        <div class="table-responsive">
                                            <table id="table-courses" class="table border">
                                                <thead>
                                                <tr class="text-center">
                                                    <th scope="col" class="text-left" style="width: 5%;">
                                                        <small><strong>N°</strong></small>
                                                    </th>
                                                    <th scope="col" class="text-left">
                                                        <small><strong>Curso</strong></small>
                                                    </th>
                                                    <th scope="col" class="text-left" style="width: 7%;">
                                                        <small><strong>Porc*</strong></small>
                                                    </th>
                                                    <th scope="col" class="text-left" style="width: 50%;">
                                                        <small><strong>Recomendación</strong></small>
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody id="table-courses-body">
                                                </tbody>
                                            </table>
                                            <small class="mb-3">
                                                <strong>*</strong> Representa el porcentaje de preguntas correctas
                                                dentro del curso
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title font-weight-bold" id="exampleModalLabel">
                        Cartilla de respuestas del alumno en el examen de admisión
                    </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col col-6 pr-3">
                            <table class="table table-sm border">
                                <tbody id="questions-1">
                                </tbody>
                            </table>
                        </div>
                        <div class="col col-6 pl-3">
                            <table class="table table-sm border">
                                <tbody id="questions-2">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Schedules -->
    <div class="modal fade" id="modalSchedules" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title font-weight-bold">
                        Horarios
                    </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" id="rowSchedules">

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--<script src="public/js/datatable.js"></script>-->
    <script type="text/javascript">
        const routeAux = "<?php echo $routeAux; ?>";
    </script>
    <script src="<?php echo $routeAux; ?>public/js/components/Badge.js"></script>
    <script src="<?php echo $routeAux; ?>public/js/components/Card.js"></script>
    <script src="<?php echo $routeAux; ?>public/js/components/Select.js"></script>
    <script src="<?php echo $routeAux; ?>public/js/components/Table.js"></script>
    <script src="<?php echo $routeAux; ?>public/js/studentView.js"></script>


<?php
require_once COMPONENT_PATH . "downpart.php";
?>