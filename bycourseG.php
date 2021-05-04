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
            <div class="card-body">
                <div class="row d-flex justify-content-between">
                    <div class="col col-12 col-lg-4 mb-2">
                        <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#collapseFilter" role="button"
                           aria-expanded="false" aria-controls="collapseExample">
                            <i class="bi bi-funnel-fill mr-2"></i>Filtros
                        </a>
                        <div class="collapse mt-2" id="collapseFilter">
                            <div class="card card-body bg-light">
                                <div class="row">
                                    <div class="col col-6 col-lg-12">
                                        <div class="d-flex bd-highlight">
                                            <div class="form-group w-100">
                                                <label for="status" class="col-form-label col-form-label-sm"><i class="bi bi-star mr-2"></i>Estado</label>
                                                <select class="form-control form-control-sm" id="status">
                                                    <option value="3" selected>Requiere nivelacion obligatorio</option>
                                                    <option value="2">Puede tomar nivelacion, pero no es obligatorio
                                                    </option>
                                                    <option value="1">No requiere nivelacion</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col col-6 col-lg-12">
                                        <div class="d-flex bd-highlight">
                                            <div class="form-group w-100">
                                                <label for="tipeChart" class="col-form-label col-form-label-sm"><i class="bi bi-bar-chart-line mr-2"></i>Tipo de
                                                    Gráfico</label>
                                                <select class="form-control form-control-sm" id="tipeChart">
                                                    <option value="" selected>Seleccione...</option>
                                                    <option value="horizontalBar">Diagrama de barras horizontal</option>
                                                    <option value="bar">Diagrama de barras vertical</option>
                                                    <option value="pie">Diagrama de pastel</option>
                                                    <option value="doughnut">Diagrama de anillo</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info my-3" role="alert">
                            <div class="row">

                                <div class="col col-1 col-lg-2">
                                    <h2>
                                        <i class="bi bi-info-circle-fill"></i>
                                    </h2>
                                </div>
                                <div class="col col-11 col-lg-10">
                                    <div class="text-md font-weight-bold text-primary mb-2">
                                        Proceso <span
                                                class="badge bg-primary text-light"><?php echo $_POST['processChart'] ?></span>
                                        <input type="hidden" id="process" name="process"
                                               value="<?php echo $_POST['processChart'] ?>">
                                    </div>
                                    <p>
                                        Muestra la cantidad de <strong>estudiantes</strong> por <strong>curso</strong>
                                        según el <strong>estado</strong> dirijase
                                        <a href="bycourse">aqui</a>.
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col col-12 col-lg-8 mt-2">
                        <canvas id="chart" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"
            integrity="sha512-vBmx0N/uQOXznm/Nbkp7h0P1RfLSj0HQrFSzV8m7rOGyj30fYAOKHYvCNez+yM8IrfnW0TCodDEjRqf6fodf/Q=="
            crossorigin="anonymous"></script>


    <script src="public/js/graphics/bycourseG.js"></script>

<?php
require_once COMPONENT_PATH . "downpart.php";
?>