<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(DB_PATH . "MySqlConnection.php");

$conn = (new MySqlConnection())->getConnection();
$sql = "SELECT * FROM areas ORDER BY name;";
?>


<div class="row">

    <?php
    foreach ($conn->query($sql) as $row) {
        $id = $row['id'];
    ?>
        <!-- Area -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 ">
                <div class="card-header text-center">
                    <div class="text-md font-weight-bold text-primary text-uppercase">
                        Área (<span class="badge bg-primary text-light"><?php echo $row['name'] ?></span>)</div>
                </div>
                <div class="card-body text-center">
                    <a href="areainschool.php" class="btn btn-primary">Ver area</a>
                </div>
            </div>
        </div>
    <?php
    } ?>
    <!-- Area ADD-->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 ">
            <div class="card-header text-center">
                <div class="text-md font-weight-bold text-primary text-uppercase">
                    Crear
                </div>
            </div>
            <div class="card-body text-center">
                <a href="#" class="link-add-card text-secondary" data-toggle="modal" data-target="#add-area"> <i class="fas fa-plus-circle"></i></a>
            </div>
        </div>
    </div>
</div>