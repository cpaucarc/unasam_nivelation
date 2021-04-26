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
                    <form action="http://localhost/nivelation/bycourseG.php" method="post" class="mx-2">
                        <input name="processChart" id="processChart" required type="text"
                               placeholder="Requerid process">
                        <button type="submit" class="btn btn-outline-danger">
                            <i class="fas fa-chart-pie"></i>
                        </button>
                    </form>
                    <form action="reporte/curso" method="post">
                        <input name="areaPdf" id="areaPdf" type="text" placeholder="No requerid area">
                        <input name="dimensionPdf" id="dimensionPdf" type="text" placeholder="No requerid dimension">
                        <input name="coursePdf" id="coursePdf" type="text" placeholder="No requerid course">
                        <input name="processPdf" id="processPdf" required type="text" placeholder="Requerid process">
                        <button type="submit" class="btn btn-outline-danger">
                            <i class="fas fa-file-pdf"></i>
                        </button>
                    </form>
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