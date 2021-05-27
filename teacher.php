<?php
require_once 'dirs.php';
require_once UTIL_PATH . "sessions/SessionStarted.php";
session_start();
$sessionStarted = new SessionStarted();
$sessionStarted->verifySessionStarted();

require_once $sessionStarted->getUpperPartByUserType();
?>
<div class="container">

    <div class="card mb-4">
        <div class="card-body ">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <?php if (intval($_SESSION['user_logged']['utid']) === 1) { ?>
                    <button type="button" class="btn btn-primary btn-sm my-2" data-toggle="modal"
                            data-target="#teacher_modal" id="new-teacher">
                        <i class="bi bi-plus mr-2"></i>Nuevo docente
                    </button>
                <?php } ?>
            </div>
            <div id="table-courses">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table id="table-teachers" class="table table-sm border">
                                <thead class="thead-light">
                                <tr>
                                    <th style="width: 15px;"><small><strong>N°</strong></small></th>
                                    <th><small><strong>DNI</strong></small></th>
                                    <th><small><strong>Nombre</strong></small></th>
                                    <th style="width: 40px;"><small><strong>Género</strong></small></th>
                                    <th><small><strong>Curso</strong></small></th>
                                    <th><small><strong>Programa</strong></small></th>
                                    <th style="width: 15px;"><small><strong>Area</strong></small></th>
                                    <th style="width: 50px;"><small><strong>Estado</strong></small></th>
                                    <th style="width: 5px;">&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody id="table-body">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Registro de Usuarios -->
    <div class="modal fade" id="teacher_modal" data-backdrop="static" data-keyboard="false" tabindex="-1"
         aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="teacher-form">
                    <div class="modal-body">
                        <input type="hidden" id="teacherID" name="teacherID" value="0" readonly>
                        <div class="form-group row">
                            <label for="dni"
                                   class="col-sm-3 col-form-label col-form-label-sm text-right">DNI</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm" id="dni"
                                       name="dni" pattern="\d{8}" title="El DNI debe tener 8 dígitos" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gender"
                                   class="col-sm-3 col-form-label col-form-label-sm text-right">Género</label>
                            <div class="col-sm-9">
                                <select name="gender" id="gender" class="form-control form-control-sm" required>
                                    <option value="0" selected>Seleccione...</option>
                                    <option value="1">Femenino</option>
                                    <option value="2">Masculino</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name"
                                   class="col-sm-3 col-form-label col-form-label-sm text-right">Nombres</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm" id="name"
                                       name="name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lastname"
                                   class="col-sm-3 col-form-label col-form-label-sm text-right">Apellidos</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm" id="lastname"
                                       name="lastname"
                                       required>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label for="course"
                                   class="col-sm-3 col-form-label col-form-label-sm text-right">Curso</label>
                            <div class="col-sm-9">
                                <select class="form-control form-control-sm" id="course" name="course" required>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="area"
                                   class="col-sm-3 col-form-label col-form-label-sm text-right">Área</label>
                            <div class="col-sm-9">
                                <select class="form-control form-control-sm" id="area" name="area" required>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="program"
                                   class="col-sm-3 col-form-label col-form-label-sm text-right">Programa
                                Acedémico</label>
                            <div class="col-sm-9">
                                <select class="form-control form-control-sm" id="program" name="program" required>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
                        <input type="submit" id="submit" class="btn btn-primary btn-sm" value="Registrar Nuevo Docente">

                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="job_modal" data-backdrop="static" data-keyboard="false" tabindex="-1"
         aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="job-form">
                    <div class="modal-header">
                        <p class="modal-title">
                            Estado laboral de <span id="teacher" class="font-weight-bold"></span>
                        </p>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="teacherJobID" name="teacherJobID" value="0" readonly>
                        <div class="form-group row">
                            <label for="status" class="col-sm-4 col-form-label col-form-label-sm text-right">
                                Estado actual:
                            </label>
                            <div class="col-sm-8">
                                <div id="current">

                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-sm-4 col-form-label col-form-label-sm text-right">
                                Cambiar estado a:
                            </label>
                            <div class="col-sm-8">
                                <select name="status" id="status" class="form-control form-control-sm" required>
                                    <option value="1" selected>Activo</option>
                                    <option value="0">Despedido</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
                        <input type="submit" id="submit" class="btn btn-primary btn-sm" value="Cambiar estado">
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<script src="public/js/components/Badge.js"></script>
<script src="public/js/components/Button.js"></script>
<script src="public/js/components/SweetAlerts.js"></script>
<script src="public/js/components/Select.js"></script>
<script src="public/js/components/Table.js"></script>
<script src="public/js/teacher.js"></script>

<?php
require_once COMPONENT_PATH . "downpart.php";
?>
