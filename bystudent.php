<?php
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

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="input-group">
                <input list="students" class="form-control" name="txSearch" id="txSearch"/>
                <datalist id="students">
                    <option value="Chrome">
                    <option value="Firefox">
                    <option value="Internet Explorer">
                    <option value="Opera">
                    <option value="Safari">
                    <option value="Microsoft Edge">
                </datalist>

                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit" id="btSearch">
                        <i class="fas fa-search "></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div id="student-info-card">
                <!-- Student Info Card Here-->
            </div>

            <div id="not-student-card">
                <!-- Jsut when stdID in POST is 0 -->
            </div>
        </div>
    </div>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabla estudiantes</h6>
        </div>
        <div class="card-body ">
            <div id="table-courses">
                <div class="table-responsive">
                    <table id="table-courses" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr class="text-center">
                            <th>N°</th>
                            <th>Curso</th>
                            <th>Porcentaje</th>
                            <th>Recomendación</th>
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
<!-- /.container-fluid -->

<?php
require_once "app/components/downpart.php";
?>
<!--<script src="public/js/datatable.js"></script>-->
<script src="public/js/components/Card.js"></script>
<script src="public/js/studentView.js"></script>
