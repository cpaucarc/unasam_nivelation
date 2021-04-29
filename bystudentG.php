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

                    <div class="d-flex bd-highlight">
                        <div class="form-group w-100">
                            <label for="process">Proceso de Admisión</label>
                            <select class="form-control" id="process">
                            </select>
                        </div>
                    </div>

                    <div class="d-flex bd-highlight">
                        <div class="form-group w-100">
                            <label for="tipeChart">Tipos de filtro</label>
                            <select class="form-control" id="tipeChart">
                                <option value="" selected>Seleccione...</option>
                                <option value="horizontalBar">Diagrama de barras horizontal</option>
                                <option value="bar">Diagrama de barras vertical</option>
                                <option value="pie">Diagrama pastel</option>
                                <option value="doughnut">Diagrama tipo doughnut</option>
                            </select>
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
                                    Proceso <span class="badge bg-primary text-light badge-process"></span>
                                </div>
                                <p>
                                    Muestra la cantidad de <strong>estudiantes</strong> general según el <strong>estado</strong> dirijase
                                    <a href="bystudent">aqui</a>.
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js" integrity="sha512-vBmx0N/uQOXznm/Nbkp7h0P1RfLSj0HQrFSzV8m7rOGyj30fYAOKHYvCNez+yM8IrfnW0TCodDEjRqf6fodf/Q==" crossorigin="anonymous"></script>


<script src="public/js/components/Select.js"></script>
<script src="public/js/graphics/bystudentG.js"></script>

<?php
require_once COMPONENT_PATH . "downpart.php";
?>