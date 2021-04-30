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
                            <h4>Información personal</h4>
                        </div>
                        <form id="personal-info">
                            <input type="hidden" name="id" value="<?php echo $_SESSION['user_logged']['id']; ?>">
                            <div class="form-group">
                                <label for="dni">DNI:</label>
                                <input type="number" class="form-control bg-light" id="dni" name="dni" minlength="8"
                                       maxlength="8" value="<?php echo $_SESSION['user_logged']['dni']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="lastname">Apellidos:</label>
                                <input type="text" class="form-control bg-light" id="lastname" name="lastname"
                                       value="<?php echo $_SESSION['user_logged']['lastname']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Nombres:</label>
                                <input type="text" class="form-control bg-light" id="name" name="name"
                                       value="<?php echo $_SESSION['user_logged']['name']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="gender">Género</label>
                                <select name="gender" id="gender" class="form-control bg-light" required>
                                    <option value="1">Femenino</option>
                                    <option value="2">Masculino</option>
                                </select>
                            </div>
                            <div class="form-group d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary mt-3">
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
                                    Su rol <span
                                            class="font-weight-bold"><?php echo $_SESSION['user_logged']['rol']; ?></span>
                                    solo puede ser modificado por el administrador.
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
                            <h4>Información de acceso</h4>
                        </div>
                        <form id="access-info">
                            <input type="hidden" name="id" value="<?php echo $_SESSION['user_logged']['id']; ?>">
                            <div class="form-group">
                                <label for="username">Usuario:</label>
                                <input type="text" class="form-control bg-light" id="username" name="username"
                                       value="<?php echo $_SESSION['user_logged']['username']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña:</label>
                                <input type="password" class="form-control bg-light" id="password" name="password"
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="repeat">Repetir Contraseña:</label>
                                <input type="password" class="form-control bg-light" id="repeat" name="repeat"
                                       required>
                            </div>
                            <div class="form-group d-flex justify-content-end">
                                <button type="submit" class="btn btn-dark mt-3">
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
    <script src="public/js/profile.js"></script>

<?php
require_once COMPONENT_PATH . "downpart.php";
?>