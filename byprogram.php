<?php
require_once "dirs.php";
require_once UTIL_PATH . "sessions/SessionStarted.php";
session_start();
(new SessionStarted())->verifySessionStarted();
?>

<?php
require_once COMPONENT_PATH . "upperpart.php";
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
                        <label for="school">Escuelas</label>
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
                    <form action="http://localhost/nivelation/byprogramG.php" method="post" class="mx-2">
                        <input name="processChart" id="processChart" required type="text"
                               placeholder="Requerid process">
                        <button type="submit" class="btn btn-outline-danger">
                            <i class="fas fa-chart-pie"></i>
                        </button>
                    </form>
                    <form action="reporte/escuela" method="post">
                        <input name="areaPdf" id="areaPdf" type="text" placeholder="No requerid area">
                        <input name="programPdf" id="programPdf" type="text" placeholder="No requerid program">
                        <input name="processPdf" id="processPdf" required type="text" placeholder="Requerid process">
                        <button type="submit" class="btn btn-outline-danger">
                            <i class="fas fa-file-pdf"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <!--Tabla-->
                <table class="table table-bordered mt-2" id="table-students">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">DNI</th>
                        <th scope="col">Código</th>
                        <th scope="col">Alumno</th>
                        <th scope="col">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">
                    </tbody>
                </table>
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