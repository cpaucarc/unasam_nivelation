<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(UTIL_PATH . "sessions/SessionStarted.php");
session_start();
(new SessionStarted())->verifySessionStarted();
$stdID = empty ($_GET['std']) ? 0 : $_GET['std'];
?>

<?php
require_once(COMPONENT_PATH . "upperpart.php");
?>
<!-- Begin Page Content -->
<div class="container">

    <!-- 404 Error Text -->
    <div class="text-center">
        <div class="error mx-auto" data-text="404">404</div>
        <p class="lead text-gray-800 mb-5">Página no entrontrada</p>
        <p class="text-gray-500 mb-0">¡Parece que encontraste un error! </p>
        <br>
        <h3 class="text-gray-500 mb-0">:( </h3>
        <br>
        <a href="index.php">&larr; Volver al inicio</a>
    </div>
</div>
<!-- /.container-fluid -->
<?php
require_once(COMPONENT_PATH . "downpart.php");
?>