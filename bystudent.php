<?php
require_once "dirs.php";
require_once UTIL_PATH . "sessions/SessionStarted.php";
session_start();
$sessionStarted = new SessionStarted();
$sessionStarted->verifySessionStarted();
$stdID = empty($_GET['std']) ? 0 : $_GET['std'];
$routeAux = empty($_GET['std']) ? "" : "../";

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

                    <?php if (intval($_SESSION['user_logged']['utid']) === 1) { ?>
                        <div class="cp-2 bd-highlight w-50">
                            <div class="input-group">
                                <input list="students" class="form-control form-control-sm" name="txSearch"
                                       id="txSearch"/>

                                <datalist id="students">
                                </datalist>
                                <div class="input-group-append">
                                    <button class="btn btn-primary btn-sm" type="submit" id="btSearch">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="ml-auto bd-highlight d-flex">
                        <div class="dropdown ml-2">
                            <a class="btn btn-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-graph-up mr-2"></i>Reportes y Graficos
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <h6 class="dropdown-header">Reportes</h6>
                                <a>
                                    <form action="<?php echo $routeAux; ?>reporte/estudiante" method="post"
                                          target="_blank">
                                        <input id="studentPdf" name="studentPdf" required type="hidden">
                                        <button type="submit" class="dropdown-item">
                                            <i class="bi bi-stop mr-2"></i>Ver este alumno
                                        </button>
                                    </form>
                                </a>
                                <div class="dropdown-divider"></div>
                                <h6 class="dropdown-header">Gráficos</h6>
                                <a>
                                    <form action="http://localhost/nivelation/bystudentG.php" target="_blank"
                                          method="post"
                                          class="mx-2">
                                        <button type="submit" class="dropdown-item">
                                            <i class="bi bi-pie-chart-fill mr-2"></i> Ver Graficos
                                        </button>
                                    </form>
                                </a>
                            </div>

                        </div>
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
                        <div class="card text-left">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold">Analisis de cursos</h6>
                            </div>
                            <div class="card-body p-0">
                                <table id="table-courses" class="table table-bordered">
                                    <thead class="thead-light">
                                    <tr class="text-center">
                                        <th scope="col" class="text-left" style="width: 5%;">
                                            <small><strong>N°</strong></small>
                                        </th>
                                        <th scope="col" class="text-left" style="width: 35%;">
                                            <small><strong>Curso</strong></small>
                                        </th>
                                        <th scope="col" class="text-left" style="width: 7%;">
                                            <small><strong>Porc*</strong></small>
                                        </th>
                                        <th scope="col" class="text-left">
                                            <small><strong>Recomendación</strong></small>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody id="table-courses-body">
                                    </tbody>
                                </table>
                                <small class="pl-4 mb-3">
                                    <strong>*</strong> Representa el porcentaje de preguntas correctas dentro del curso
                                </small>
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
                    <h5 class="modal-title" id="exampleModalLabel">
                        Respuestas del alumno en el examen de admisión
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col col-6">
                            <table class="table table-sm table-bordered">
                                <tbody id="questions-1">
                                </tbody>
                            </table>
                        </div>
                        <div class="col col-6">
                            <table class="table table-sm table-bordered">
                                <tbody id="questions-2">
                                </tbody>
                            </table>
                        </div>
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