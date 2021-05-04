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
                    <label for="area">Area</label>
                    <select class="form-control" id="area">
                        <option value="0">Selecciona...</option>
                        <option value="1">A</option>
                        <option value="2">B</option>
                        <option value="3">C</option>
                        <option value="4">D</option>
                    </select>
                </div>
                <div class="ml-4 bd-highlight">
                    <label for="dimension">Dimensión</label>
                    <select class="form-control" id="dimension">
                    </select>
                </div>
                <div class="ml-4 bd-highlight">
                    <label for="course">Curso</label>
                    <select class="form-control" id="course">
                    </select>
                </div>
                <div class="ml-auto bd-highlight">
                    <label for="process">Proceso de Admisión</label>
                    <select class="form-control" id="process">
                    </select>
                </div>
            </div>
        </div>
        <div class="d-flex bd-highlight mr-4 mt-3 justify-content-end">
            <div class="ml-auto bd-highlight d-flex">
                <div class="dropdown ml-2">
                    <a class="btn btn-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bi bi-graph-up mr-2"></i>Reportes y Graficos
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <h6 class="dropdown-header">Reportes</h6>
                        <a>
                            <form action="reporte/curso" target="_blank" method="post">
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
                            <form action="reporte/curso" target="_blank" method="post">
                                <input id="areaPdf_2" name="areaPdf" required type="hidden">
                                <input id="dimensionPdf_2" name="dimensionPdf" required type="hidden">
                                <input id="processPdf_2" name="processPdf" required type="hidden">
                                <button type="submit" class="dropdown-item">
                                    <i class="bi bi-grid mr-2"></i>Ver todos los cursos
                                </button>
                            </form>
                        </a>
                        <a>
                            <form action="reporte/curso"  target="_blank" method="post">
                                <input id="areaPdf_3" name="areaPdf" required type="hidden">
                                <input id="processPdf_3" name="processPdf" required type="hidden">
                                <button type="submit" class="dropdown-item">
                                    <i class="bi bi-grid-3x2-gap mr-2"></i>Ver todas las dimensiones
                                </button>
                            </form>
                        </a>
                        <a>
                            <form action="reporte/curso" target="_blank" method="post">
                                <input id="processPdf_4" name="processPdf" required type="hidden">
                                <button type="submit" class="dropdown-item">
                                    <i class="bi bi-grid-3x3-gap mr-2"></i>Ver todas las Áreas
                                </button>
                            </form>
                        </a>
                        <div class="dropdown-divider"></div>
                        <h6 class="dropdown-header">Gráficos</h6>
                        <a>
                            <form action="http://localhost/nivelation/bycourseG.php"  target="_blank" method="post" class="mx-2">
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
                            <th scope="col" style="width: 5%;">N°</th>
                            <th scope="col" style="width: 10%;">Código</th>
                            <th scope="col" style="width: 20%;">Alumno</th>
                            <th scope="col" style="width: 20%;">Escuela</th>
                            <th scope="col">Recomendación</th>
                            <th scope="col" style="width: 3%;">&nbsp;</th>
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