<?php
include_once 'dirs.php';
require_once(DB_PATH . "MySqlConnection.php");

$conn = (new MySqlConnection())->getConnection();
$sql = "SELECT * FROM vusers ORDER BY lastname;";
?>

<div class="table-responsive">
    <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="table-users">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">DNI</th>
            <th scope="col">Nombre</th>
            <th scope="col">Rol</th>
            <th scope="col">Usuario</th>
            <th scope="col">Acción</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $i = 1;
        foreach ($conn->query($sql) as $row) {
            $id = $row['id'];
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row['dni'] ?></td>
                <td><?php echo $row['lastname'] . ' ' . $row['name'] ?></td>
                <td><?php echo $row['rol'] ?></td>
                <td><?php echo $row['username'] ?></td>
                <td class="text-center">
                        <span class="btn btn-outline-danger btn-sm" onclick="deleteUser('<?php echo $id ?>')">
                        <i class="fas fa-trash"></i>
                        </span>
                </td>
            </tr>
            <?php $i++;
        } ?>
        </tbody>
    </table>
</div>
<script src="public/js/main.js"></script>