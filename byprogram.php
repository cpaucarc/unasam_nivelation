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
                        <label for="school">Programa</label>
                        <select class="form-control" id="school">
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
                        <a class="btn btn-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-graph-up mr-2"></i>Reportes y Graficos
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <h6 class="dropdown-header">Reportes</h6>
                            <a>
                                <form action="reporte/programa" method="post">
                                    <input id="areaPdf_1" name="areaPdf" required type="hidden">
                                    <input id="programPdf_1" name="programPdf" required type="hidden">
                                    <input id="processPdf_1" name="processPdf" required type="hidden">
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-stop mr-2"></i>Ver solo este Programa
                                    </button>
                                </form>
                            </a>
                            <a>
                                <form action="reporte/programa" method="post">
                                    <input id="areaPdf_2" name="areaPdf" required type="hidden">
                                    <input id="processPdf_2" name="processPdf" required type="hidden">
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-grid mr-2"></i>Ver todos los Programas
                                    </button>
                                </form>
                            </a>
                            <a>
                                <form action="reporte/programa" method="post">
                                    <input id="processPdf_3" name="processPdf" required type="hidden">
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-grid-3x2-gap mr-2"></i>Ver todas las Áreas
                                    </button>
                                </form>
                            </a>
                            <div class="dropdown-divider"></div>
                            <h6 class="dropdown-header">Gráficos</h6>
                            <a>
                                <form action="http://localhost/nivelation/byprogramG.php" method="post" class="mx-2">
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
                <!--Tabla-->
                <table class="table table-bordered mt-2" id="table-students">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col" style="width: 5%;"><small><strong>N°</strong></small></th>
                        <th scope="col" style="width: 5%;"><small><strong>OMG</strong></small></th>
                        <th scope="col" style="width: 5%;"><small><strong>OMP</strong></small></th>
                        <th scope="col" style="width: 12%;"><small><strong>DNI</strong></small></th>
                        <th scope="col" style="width: 13%;"><small><strong>Código</strong></small></th>
                        <th scope="col"><small><strong>Estudiante</strong></small></th>
                        <th scope="col" style="width: 5%;"><small><strong>&nbsp;</strong></small></th>
                    </tr>
                    </thead>
                    <tbody id="tbody">
                    </tbody>
                </table>

                <div class="alert alert-dark mt-4" role="alert">
                    <ul class="mb-0">
                        <li><strong>OMG</strong>: Orden de Mérito General</li>
                        <li><strong>OMP</strong>: Orden de Mérito por Programa Académico</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    <script src="public/js/components/Table.js"></script>
    <script src="public/js/components/Button.js"></script>
    <script src="public/js/components/Select.js"></script>
    <script src="public/js/components/Badge.js"></script>
    <script src="public/js/schoolsView.js"></script>

<?php
require_once COMPONENT_PATH . "downpart.php";
?>