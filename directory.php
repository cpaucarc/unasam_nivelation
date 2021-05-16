<?php
require_once 'dirs.php';
require_once UTIL_PATH . "sessions/SessionStarted.php";
session_start();
$sessionStarted = new SessionStarted();
$sessionStarted->verifySessionStarted();

require_once $sessionStarted->getUpperPartByUserType();

if (intval($_SESSION['user_logged']['utid']) === 1) {
    ?>
    <div class="container">

        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-4">
                    <div>
                        <small class="mr-4">
                            <i class="bi bi-file-earmark-medical"></i>
                            <span class="mr-1">Archivos:</span>
                            <span id="count-files">0</span>
                        </small>
                        <small>
                            <i class="bi bi-hdd"></i>
                            <span class="mr-1">Tamaño Total:</span>
                            <span id="weight-files">0 Kb</span>
                        </small>
                    </div>

                    <button class="btn btn-light btn-sm text-danger" id="delete-all">
                        <i class="bi bi-trash mr-2"></i>Eliminar todos los archivos
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table border rounded">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col"><small><strong>N°</strong></small></th>
                            <th scope="col"><small><strong>Nombre de archivo</strong></small></th>
                            <th scope="col"><small><strong>Tamaño</strong></small></th>
                            <th scope="col"><small><strong>Fecha de subida</strong></small></th>
                            <th scope="col"><small><strong>&nbsp;</strong></small></th>
                        </tr>
                        </thead>
                        <tbody id="tbody">

                        </tbody>
                    </table>
                </div>
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <small>
                        Los archivos se almacenan para su consulta posterior, en caso de que ocupen demasiado espacio,
                        considere eliminarlos para mejorar el rendimiento de la aplicación.
                    </small>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>

    </div>

    <script src="public/js/components/Table.js"></script>
    <script src="public/js/components/Button.js"></script>
    <script src="public/js/files.js"></script>
<?php } else {
    ?>
    <div class="container">

        <div class="card">
            <div class="card-body">
                <div class="text-center mb-3 text-danger">
                    <h4><i class="bi bi-paperclip"></i>Lo sentimos, actualmente no hay archivos para mostrar</h4>
                </div>
                <div class="d-flex justify-content-center">
                    <img src="public/images/files.svg" class="w-50 p-5" alt="imagen de bienvenida" loading="lazy">
                </div>
            </div>
        </div>

    </div>
    <script>
        window.addEventListener('load', () => {
            document.getElementById('view-title').innerText = 'Archivos';
        });
    </script>

    <?php
}
require_once COMPONENT_PATH . "downpart.php";
?>