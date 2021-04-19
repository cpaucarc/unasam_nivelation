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
                <div class="ml-auto bd-highlight">
                    <form action="reporte/curso" method="post">
                        <input name="csAREAPDF" id="csAREAPDF" type="hidden">
                        <input name="csCOURSEPDF" id="csCOURSEPDF" type="hidden">
                        <input name="csPROCESSPDF" id="csPROCESSPDF" type="hidden">
                        <button type="submit" id="btShowPDF" class="btn btn-outline-danger">
                            <i class="fas fa-file-pdf"></i>
                        </button>
                    </form>

                </div>
            </div>
            <div class="card-body">

                <!--Tabla-->
                <table class="table mt-2" id="table-students">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">DNI</th>
                        <th scope="col">Código</th>
                        <th scope="col">Alumno</th>
                        <th scope="col">Escuela</th>
                        <th scope="col">Recomendación</th>
                        <th scope="col">Acción</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">

                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script src="public/js/components/Table.js"></script>
    <script src="public/js/components/Button.js"></script>
    <script src="public/js/components/Badge.js"></script>
    <script src="public/js/courseView.js"></script>

<?php
require_once COMPONENT_PATH . "downpart.php";
?>