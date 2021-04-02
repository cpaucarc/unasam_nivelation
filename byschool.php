<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(UTIL_PATH . "sessions/SessionStarted.php");
session_start();
(new SessionStarted())->verifySessionStarted();
?>

<?php
require_once(COMPONENT_PATH . "upperpart.php");
?>


<!-- Begin Page Content -->
<div class="container-fluid">

    <h2 class="text-dark">Reporte por escuelas</h2>

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
            <div class="ml-auto bd-highlight">
                <form action="http://localhost/nivelation/reporte/escuela" method="post">
                    <input name="scAREAPDF" id="scAREAPDF" type="hidden">
                    <input name="scSCHOOLPDF" id="scSCHOOLPDF" type="hidden">
                    <input name="scPROCESSPDF" id="scPROCESSPDF" type="hidden">
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
                    <th scope="col">Acción</th>
                </tr>
                </thead>
                <tbody id="tbody">

                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<script src="http://localhost/nivelation/public/js/components/Table.js"></script>
<script src="http://localhost/nivelation/public/js/components/Button.js"></script>
<script src="http://localhost/nivelation/public/js/components/Alert.js"></script>
<script src="http://localhost/nivelation/public/js/schoolsView.js"></script>

<?php
require_once(COMPONENT_PATH . "downpart.php");
?>
<!--<script src="public/js/datatable.js"></script>-->