<?php
require_once 'dirs.php';
require_once UTIL_PATH . "sessions/SessionStarted.php";
session_start();
$sessionStarted = new SessionStarted();
$sessionStarted->verifySessionStarted();

require_once $sessionStarted->getUpperPartByUserType();
?>
    <div class="container">
        <div class="row d-flex justify-content-around mt-5">
            <div class="col col-10 col-lg-5">
                <div class="card mb-4 rounded">
                    <div class="card-body">
                        <div class="card-title font-weight-bold text-dark mb-3">
                            <h5>Mi información personal</h5>
                        </div>
                        <form id="personal-info">
                            <input type="hidden" name="id" value="<?php echo $_SESSION['user_logged']['id']; ?>">
                            <div class="form-group">
                                <label for="dni" class="col-form-label col-form-label-sm">DNI:</label>
                                <input type="number" class="form-control form-control-sm" id="dni" name="dni"
                                       minlength="8"
                                       maxlength="8" value="<?php echo $_SESSION['user_logged']['dni']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="lastname" class="col-form-label col-form-label-sm">Apellidos:</label>
                                <input type="text" class="form-control form-control-sm" id="lastname" name="lastname"
                                       value="<?php echo $_SESSION['user_logged']['lastname']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-form-label col-form-label-sm">Nombres:</label>
                                <input type="text" class="form-control form-control-sm" id="name" name="name"
                                       value="<?php echo $_SESSION['user_logged']['name']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="gender" class="col-form-label col-form-label-sm">Género</label>
                                <select name="gender" id="gender" class="form-control form-control-sm" required>
                                    <option value="1">Femenino</option>
                                    <option value="2">Masculino</option>
                                </select>
                            </div>
                            <div class="form-group d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary btn-sm mt-3">
                                    Guardar informacion personal
                                </button>
                            </div>
                        </form>
                        <div class="alert alert-info mt-3 alert-dismissible fade show" role="alert">
                            <div class="row">
                                <div class="col col-2">
                                    <h2>
                                        <i class="bi bi-info-circle-fill"></i>
                                    </h2>
                                </div>
                                <div class="col col-10">
                                    <small>
                                        Su rol <span
                                                class="font-weight-bold"><?php echo $_SESSION['user_logged']['rol']; ?></span>
                                        solo puede ser modificado por el administrador.
                                    </small>
                                </div>
                            </div>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-10 col-lg-5">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="card-title font-weight-bold text-dark mb-3">
                            <h5>Cambiar mi información de acceso</h5>
                        </div>
                        <form id="access-info">
                            <input type="hidden" name="id" value="<?php echo $_SESSION['user_logged']['id']; ?>">
                            <div class="form-group">
                                <label for="username" class="col-form-label col-form-label-sm">Mi nombre de
                                    usuario:</label>
                                <input type="text" class="form-control form-control-sm" id="username" name="username"
                                       value="<?php echo $_SESSION['user_logged']['username']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-form-label col-form-label-sm">Mi nueva
                                    Contraseña:</label>
                                <input type="password" class="form-control form-control-sm" id="password"
                                       name="password"
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="repeat" class="col-form-label col-form-label-sm">Repetir mi nueva
                                    Contraseña:</label>
                                <input type="password" class="form-control form-control-sm" id="repeat" name="repeat"
                                       required>
                            </div>
                            <div class="form-group d-flex justify-content-end">
                                <button type="submit" class="btn btn-dark btn-sm mt-3">
                                    Guardar informacion de acceso
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const gender = '<?php echo $_SESSION['user_logged']['gender']; ?>';
    </script>
    <script src="public/js/components/SweetAlerts.js"></script>
    <script src="public/js/profile.js"></script>

<?php
require_once COMPONENT_PATH . "downpart.php";
?>