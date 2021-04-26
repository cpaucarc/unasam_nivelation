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
            <div class="d-flex bd-highlight">
                <div class="form-group">
                    <label for="process">Proceso de Admisión</label>
                    <select class="form-control" id="process">
                    </select>
                </div>
            </div>

        </div>
    </div>
    <div class="row my-3">
        <div class="col col-lg-6 col-md-6 col-sm-12 col-12 mb-4">
            <div class="card">
                <div class="card-header text-center">
                    <div class="text-md font-weight-bold text-primary">
                        Proceso <span class="badge bg-primary text-light badge-process"></span>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="chartDoughnut" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col col-lg-6 col-md-6 col-sm-12 col-12 mb-4">
            <div class="card">
                <div class="card-header text-center">
                    <div class="text-md font-weight-bold text-primary">
                        Proceso <span class="badge bg-primary text-light badge-process"></span>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="chartBar" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col col-lg-6 col-md-6 col-sm-12 col-12 mb-4">
            <div class="card">
                <div class="card-header text-center">
                    <div class="text-md font-weight-bold text-primary">
                        Proceso <span class="badge bg-primary text-light badge-process"></span>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="chartHorizontalBar" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col col-lg-6 col-md-6 col-sm-12 col-12 mb-4">
            <div class="card">
                <div class="card-header text-center">
                    <div class="text-md font-weight-bold text-primary">
                        Proceso <span class="badge bg-primary text-light badge-process"></span>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="chartPie" height="200"></canvas>
                </div>
            </div>
        </div>

        <div class="col col-lg-6 col-md-6 col-sm-12 col-12 mb-4">
            <div class="card">
                <div class="card-header text-center">
                    <div class="text-md font-weight-bold text-primary">
                        Proceso <span class="badge bg-primary text-light badge-process"></span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
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