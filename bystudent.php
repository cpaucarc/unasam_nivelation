<?php
$std = isset($_POST['std']) ? $_POST['stdID'] : 1;
?>

<?php
require_once "app/views/upperpart.php";
?>


<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="hide">
        <input type="hidden" id="stdID" class="" value="<?php echo $std ?>">
    </div>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Reporte por Estudiante</h1>
        <select class="form-control form-control text-primary" id="semestre" style="width:120px">
            <option>Admisión</option>
            <option>2020-II</option>
            <option>2021-I</option>
            <option>2021-II</option>
            <option>2022-I</option>
            <option>2022-II</option>
        </select>

    </div>


    <div>
        <div class="card my-2">
            <div class="card-body">
                <form class="d-sm-inline-block  ">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for..."
                               aria-label="Search" aria-describedby="basic-addon2" id="txSearch">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" id="btSearch">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="student-info-card">
        <!-- Student Info Card Here-->
    </div>

    <div id="not-student-card">
        <!-- Jsut when stdID in POST is 0 -->
    </div>

    <div id="table-courses">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
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
require_once "app/views/downpart.php";
?>
<script src="public/js/components/Card.js"></script>
<script src="public/js/studentView.js"></script>
