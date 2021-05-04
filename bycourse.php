<?php
require_once "dirs.php";
require_once UTIL_PATH . "sessions/SessionStarted.php";
session_start();
$sessionStarted = new SessionStarted();
$sessionStarted->verifySessionStarted();

require_once $sessionStarted->getUpperPartByUserType();
?>
    <!-- Begin Page Content -->
    <div class="container">

        <div class="card">
            <div class="card-header">
                <div class="d-flex bd-highlight mb-3">
                    <div class="bd-highlight">
                        <label for="area" class="col-form-label col-form-label-sm">Area</label>
                        <select class="form-control form-control-sm" id="area">
                            <option value="0">Selecciona...</option>
                            <option value="1">A</option>
                            <option value="2">B</option>
                            <option value="3">C</option>
                            <option value="4">D</option>
                        </select>
                    </div>
                    <div class="ml-4 bd-highlight">
                        <label for="dimension" class="col-form-label col-form-label-sm">Dimensión</label>
                        <select class="form-control form-control-sm" id="dimension">
                        </select>
                    </div>
                    <div class="ml-4 bd-highlight">
                        <label for="course" class="col-form-label col-form-label-sm">Curso</label>
                        <select class="form-control form-control-sm" id="course">
                        </select>
                    </div>
                    <div class="ml-auto bd-highlight">
                        <label for="process" class="col-form-label col-form-label-sm">Proceso de Admisión</label>
                        <select class="form-control form-control-sm" id="process">
                        </select>
                    </div>
                </div>
            </div>
            <div class="d-flex bd-highlight mr-4 mt-3 justify-content-end">
                <div class="ml-auto bd-highlight d-flex">
                    <div class="dropdown ml-2">
                        <a class="btn btn-light btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-graph-up mr-2"></i>Reportes y Graficos
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <h6 class="dropdown-header">Reportes</h6>
                            <a>
                                <form action="reporte/curso" method="post">
                                    <input id="areaPdf_1" name="areaPdf" required type="hidden">
                                    <input id="dimensionPdf_1" name="dimensionPdf" required type="hidden">
                                    <input id="coursePdf_1" name="coursePdf" required type="hidden">
                                    <input id="processPdf_1" name="processPdf" required type="hidden">
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-stop mr-2"></i>Ver solo este curso
                                    </button>
                                </form>
                            </a>
                            <a>
                                <form action="reporte/curso" method="post">
                                    <input id="areaPdf_2" name="areaPdf" required type="hidden">
                                    <input id="dimensionPdf_2" name="dimensionPdf" required type="hidden">
                                    <input id="processPdf_2" name="processPdf" required type="hidden">
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-grid mr-2"></i>Ver todos los cursos
                                    </button>
                                </form>
                            </a>
                            <a>
                                <form action="reporte/curso" method="post">
                                    <input id="areaPdf_3" name="areaPdf" required type="hidden">
                                    <input id="processPdf_3" name="processPdf" required type="hidden">
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-grid-3x2-gap mr-2"></i>Ver todas las dimensiones
                                    </button>
                                </form>
                            </a>
                            <a>
                                <form action="reporte/curso" method="post">
                                    <input id="processPdf_4" name="processPdf" required type="hidden">
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-grid-3x3-gap mr-2"></i>Ver todas las Áreas
                                    </button>
                                </form>
                            </a>
                            <div class="dropdown-divider"></div>
                            <h6 class="dropdown-header">Gráficos</h6>
                            <a>
                                <form action="http://localhost/nivelation/bycourseG.php" method="post" class="mx-2">
                                    <input name="processChart" id="processChart" required type="hidden">
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-pie-chart-fill mr-2"></i> Ver Graficos
                                    </button>
                                </form>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <!--Tabla-->
                    <table class="table table-bordered mt-2" id="table-students">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col" style="width: 5%;"><small><strong>N°</strong></small></th>
                            <th scope="col" style="width: 10%;"><small><strong>Código</strong></small></th>
                            <th scope="col" style="width: 20%;"><small><strong>Alumno</strong></small></th>
                            <th scope="col" style="width: 20%;"><small><strong>Escuela</strong></small></th>
                            <th scope="col"><small><strong>Recomendación</strong></small></th>
                            <th scope="col" style="width: 3%;"><small><strong>&nbsp;</strong></small></th>
                        </tr>
                        </thead>
                        <tbody id="tbody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <script src="public/js/components/Table.js"></script>
    <script src="public/js/components/Button.js"></script>
    <script src="public/js/components/Select.js"></script>
    <script src="public/js/components/Badge.js"></script>
    <script src="public/js/courseView.js"></script>

<?php
require_once COMPONENT_PATH . "downpart.php";
?>