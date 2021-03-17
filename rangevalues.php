<?php
require_once "app/components/upperpart.php";
?>


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Valores de rangos</h1>
            <select class="form-control form-control text-primary" id="semestre" style="width:120px">
                <option value="Admision">Admisión</option>
                <option value="5">2020-II</option>
                <option value="4">2021-I</option>
                <option value="3">2019-II</option>
                <option value="2">2019-I</option>
                <option value="6">2022-II</option>
            </select>
        </div>

        <!--Ejemplo tabla con DataTables-->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <!-- Area -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 ">
                                <div class="card-body">
                                    <div class="text-md font-weight-bold text-primary text-uppercase">
                                        Grupo (<span class="area">A</span>)
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <!-- Default Card Example -->
                            <div class="card mb-4">
                                <div class="card-header text-dark">
                                    Física
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <input type="range" min="0" max="100" value="50"
                                               class="form-control-range range">
                                        <input type="number" min="0" max="100" value="50"
                                               class="form-control valuerange ">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <!-- Default Card Example -->
                            <div class="card mb-4">
                                <div class="card-header text-dark">
                                    Matematica
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <input type="range" min="0" max="100" value="50"
                                               class="form-control-range range">
                                        <input type="number" min="0" max="100" value="50"
                                               class="form-control valuerange ">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <!-- Default Card Example -->
                            <div class="card mb-4">
                                <div class="card-header text-dark">
                                    Quimica
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <input type="range" min="0" max="100" value="50"
                                               class="form-control-range range">
                                        <input type="number" min="0" max="100" value="50"
                                               class="form-control valuerange ">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <!-- Default Card Example -->
                            <div class="card mb-4">
                                <div class="card-header text-dark">
                                    Cultura General
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <input type="range" min="0" max="100" value="50"
                                               class="form-control-range range">
                                        <input type="number" min="0" max="100" value="50"
                                               class="form-control valuerange ">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row">
                        <!-- Area -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 ">
                                <div class="card-body">
                                    <div class="text-md font-weight-bold text-primary text-uppercase">
                                        Grupo (<span class="area">B</span>)
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <!-- Default Card Example -->
                            <div class="card mb-4">
                                <div class="card-header text-dark">
                                    Física
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <input type="range" min="0" max="100" value="50"
                                               class="form-control-range range">
                                        <input type="number" min="0" max="100" value="50"
                                               class="form-control valuerange ">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <!-- Default Card Example -->
                            <div class="card mb-4">
                                <div class="card-header text-dark">
                                    Matematica
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <input type="range" min="0" max="100" value="50"
                                               class="form-control-range range">
                                        <input type="number" min="0" max="100" value="50"
                                               class="form-control valuerange ">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <!-- Default Card Example -->
                            <div class="card mb-4">
                                <div class="card-header text-dark">
                                    Quimica
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <input type="range" min="0" max="100" value="50"
                                               class="form-control-range range">
                                        <input type="number" min="0" max="100" value="50"
                                               class="form-control valuerange ">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <!-- Default Card Example -->
                            <div class="card mb-4">
                                <div class="card-header text-dark">
                                    Cultura General
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <input type="range" min="0" max="100" value="50"
                                               class="form-control-range range">
                                        <input type="number" min="0" max="100" value="50"
                                               class="form-control valuerange ">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row">
                        <!-- Area -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 ">
                                <div class="card-body">
                                    <div class="text-md font-weight-bold text-primary text-uppercase">
                                        Grupo (<span class="area">C</span>)
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <!-- Default Card Example -->
                            <div class="card mb-4">
                                <div class="card-header text-dark">
                                    Física
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <input type="range" min="0" max="100" value="50"
                                               class="form-control-range range">
                                        <input type="number" min="0" max="100" value="50"
                                               class="form-control valuerange ">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <!-- Default Card Example -->
                            <div class="card mb-4">
                                <div class="card-header text-dark">
                                    Matematica
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <input type="range" min="0" max="100" value="50"
                                               class="form-control-range range">
                                        <input type="number" min="0" max="100" value="50"
                                               class="form-control valuerange ">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <!-- Default Card Example -->
                            <div class="card mb-4">
                                <div class="card-header text-dark">
                                    Quimica
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <input type="range" min="0" max="100" value="50"
                                               class="form-control-range range">
                                        <input type="number" min="0" max="100" value="50"
                                               class="form-control valuerange ">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <!-- Default Card Example -->
                            <div class="card mb-4">
                                <div class="card-header text-dark">
                                    Cultura general
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <input type="range" min="0" max="100" value="50"
                                               class="form-control-range range">
                                        <input type="number" min="0" max="100" value="50"
                                               class="form-control valuerange ">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <!-- Default Card Example -->
                            <div class="card mb-4">
                                <div class="card-header text-dark">
                                    Biologia
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <input type="range" min="0" max="100" value="50"
                                               class="form-control-range range">
                                        <input type="number" min="0" max="100" value="50"
                                               class="form-control valuerange ">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 d-flex justify-content-end mb-2">
                    <button class="btn btn-primary" id="saverange">Gruardar</button>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    <script src="public/js/ranks.js"></script>
    
<?php
require_once "app/components/downpart.php";
?>