<?php
session_start();
$fullname = isset($_POST['fullname']) ? $_POST['fullname'] : '';
?>

<?php
require_once "app/components/upperpart.php";
?>


    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="hide">
            <input type="hidden" id="stdID" class="" value="<?php echo $fullname ?>">
        </div>

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h5 mb-0 text-gray-800">Reporte por Estudiante</h1>
            <!--       <select class="form-control text-primary my-2" id="semestre" style="width:150px">
                      <option>Admisión</option>
                      <option>2020-II</option>
                      <option>2021-I</option>
                      <option>2021-II</option>
                      <option>2022-I</option>
                      <option>2022-II</option>
                  </select>
           -->
        </div>

        <div class="card mb-4">
            <div class="card-header py-3">
                <div class="input-group">
                    <input list="students" class="form-control" name="txSearch" id="txSearch"/>
                    <datalist id="students">
                    </datalist>

                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" id="btSearch">
                            <i class="fas fa-search "></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col col-sm-12 col-md-4 mb-3">
                        <div id="student-info-card">
                            <!-- Student Info Card Here-->
                        </div>
                        <div id="not-student-card">
                            <!-- Just when stdID in POST is 0 -->
                        </div>
                    </div>
                    <div class="col col-sm-12 col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold">Analis de cursos</h6>
                            </div>
                            <div class="card-body">
                                <table id="table-courses" class="table">
                                    <thead class="thead-light">
                                    <tr class="text-center">
                                        <th scope="col" class="text-left">N°</th>
                                        <th scope="col" class="text-left">Curso</th>
                                        <th scope="col" class="text-left">Porcentaje</th>
                                        <th scope="col" class="text-left">Recomendación</th>
                                    </tr>
                                    </thead>
                                    <tbody id="table-courses-body">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    <!--<script src="public/js/datatable.js"></script>-->
    <script src="public/js/components/Card.js"></script>
    <script src="public/js/components/Table.js"></script>
    <script src="public/js/studentView.js"></script>

<?php
require_once "app/components/downpart.php";
?>