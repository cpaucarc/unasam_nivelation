<?php
require_once 'dirs.php';
require_once UTIL_PATH . "sessions/SessionStarted.php";
session_start();
$sessionStarted = new SessionStarted();
$sessionStarted->verifySessionStarted();

require_once $sessionStarted->getUpperPartByUserType();
?>
<div class="container">

    <!--   Table with groups-->
    <div class="card mt-4">
        <div class="card-body">

            <div class="d-flex justify-content-between mt-3 mb-5">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-sm" id="newGroup" data-toggle="modal" data-target="#modalGroup">
                    <i class="bi bi-plus mr-1"></i>Nuevo grupo de clases
                </button>
            </div>

            <h5 class="card-title font-weight-bold mb-4">Grupos de clases asignadas</h5>
            <div class="table-responsive">
                <table class="table table-sm border" id="table-groups">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col"><small><strong>N°</strong></small></th>
                        <th scope="col"><small><strong>Grupo</strong></small></th>
                        <th scope="col"><small><strong>Docente</strong></small></th>
                        <th scope="col"><small><strong>Curso</strong></small></th>
                        <th scope="col"><small><strong>Proceso</strong></small></th>
                        <th scope="col"><small><strong>Área</strong></small></th>
                        <th scope="col"><small><strong>Alumnos</strong></small></th>
                        <th scope="col"><small><strong>Inicio</strong></small></th>
                        <th scope="col"><small><strong>Fin</strong></small></th>
                        <th scope="col"><small><strong>Estado</strong></small></th>
                        <th scope="col"><small><strong>&nbsp;</strong></small></th>
                    </tr>
                    </thead>
                    <tbody id="tbody-groups">
                    <tr>
                        <th scope="row" colspan="9" class="text-center">
                            <small>Cargando...</small>
                        </th>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- Modal Main -->
<div class="modal fade" data-backdrop="static" id="modalGroup" tabindex="-1" aria-labelledby="modalGroup"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-md" id="modalGroupSize">
        <div class="modal-content">
            <form id="formGroup" class="d-block">
                <div class="modal-header">
                    <h6 class="modal-title font-weight-bold text-primary">
                        Paso 1:</br>
                        <small class="text-muted"> Información del grupo</small>
                    </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col col-12 col-lg-6">
                            <div class="form-group">
                                <label for="groupName" class="col-form-label col-form-label-sm">
                                    Nombre del grupo <small class="text-muted">Es automatico</small>
                                </label>
                                <input type="text" class="form-control form-control-sm" name="groupName" id="groupName"
                                       value="Grupo 01" readonly required>
                            </div>
                        </div>
                        <div class="col col-12 col-lg-6">
                            <div class="form-group">
                                <input type="hidden" name="groupID" id="groupID" value="0" readonly>
                            </div>
                        </div>
                        <div class="col col-12 col-lg-6">
                            <div class="form-group">
                                <label for="process" class="col-form-label col-form-label-sm">
                                    Proceso
                                </label>
                                <select name="process" id="process" class="form-control form-control-sm" required>
                                </select>
                            </div>
                        </div>
                        <div class="col col-12 col-lg-6">
                            <div class="form-group">
                                <label for="area" class="col-form-label col-form-label-sm">
                                    Área
                                </label>
                                <select name="area" id="area" class="form-control form-control-sm" required>
                                </select>
                            </div>
                        </div>
                        <div class="col col-12 col-lg-6">
                            <div class="form-group">
                                <label for="dimension" class="col-form-label col-form-label-sm">
                                    Dimensión
                                </label>
                                <select name="dimension" id="dimension" class="form-control form-control-sm" required>
                                    <option value="0">Selecciona...</option>
                                    <option value="2">Matematica</option>
                                    <option value="3">Comunicacion</option>
                                    <option value="7">Tecnicas de Estudio</option>
                                </select>
                            </div>
                        </div>
                        <div class="col col-12 col-lg-6">
                            <input type="hidden" id="teacherID" name="teacherID" class="input-group" value="0" readonly>

                            <div class="form-group">
                                <label for="teacherName" class="col-form-label col-form-label-sm">
                                    Nombre del Docente
                                </label>
                                <input type="button" class="form-control form-control-sm" id="teacherName"
                                       data-toggle="modal"
                                       data-target="#modalTeacher" readonly required>
                            </div>
                        </div>
                        <div class="col col-12 col-lg-6">
                            <div class="form-group">
                                <label for="date_start" class="col-form-label col-form-label-sm">
                                    Fecha de inicio
                                </label>
                                <input type="date" id="date_start" name="date_start"
                                       class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col col-12 col-lg-6">
                            <div class="form-group">
                                <label for="date_end" class="col-form-label col-form-label-sm">
                                    Fecha de fin
                                </label>
                                <input type="date" id="date_end" name="date_end"
                                       class="form-control form-control-sm"
                                       aria-describedby="dateHelpBlock" required>
                            </div>
                        </div>
                        <div class="col col-12">
                            <small id="dateHelpBlock" class="text-danger">
                                La duración debe ser de 2 semanas. Actualmente hay 0 dias de diferencia
                            </small>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="ml-auto btn btn-light btn-sm mr-2" data-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary btn-sm">Guardar y siguiente</button>
                </div>
            </form>
            <form id="formScheduleToGroup" class="d-none">
                <div class="modal-header">
                    <h6 class="modal-title font-weight-bold text-primary">
                        Paso 2:</br>
                        <small class="text-muted"> Horarios</small>
                    </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="groupIDStep2" name="groupIDStep2" value="0" class="input-group" readonly>
                    <button type="button" class="btn btn-light btn-sm my-3" id="openScheduleModal"
                            data-toggle="modal"
                            data-target="#modalSchedule">
                        <i class="bi bi-calendar-week mr-1"></i>Agregar horario
                    </button>
                    <div class="table-responsive">
                        <table class="table table-sm border">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col"><small><strong>N°</strong></small></th>
                                <th scope="col"><small><strong>Día</strong></small></th>
                                <th scope="col"><small><strong>Inicio</strong></small></th>
                                <th scope="col"><small><strong>Fin</strong></small></th>
                                <th scope="col"><small><strong>Horas</strong></small></th>
                                <th scope="col"><small><strong>Salón</strong></small></th>
                                <th scope="col"><small><strong>&nbsp;</strong></small></th>
                            </tr>
                            </thead>
                            <tbody id="tbody-schedule">
                            </tbody>
                            <tfoot>
                            <tr>
                                <th scope="col"><small><strong>Total</strong></small></th>
                                <th scope="col" colspan="3"><small><strong>&nbsp;</strong></small></th>
                                <th scope="col" colspan="3">
                                    <small><strong>
                                            <span id="total_hours">0</span>h
                                        </strong></small>
                                </th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm">Guardar y siguiente</button>
                </div>
            </form>
            <form id="formStudents" class="d-none">
                <div class="modal-header pb-0">
                    <h6 class="modal-title font-weight-bold text-primary">
                        Paso 3:</br>
                        <small class="text-muted"> Estudiantes</small>
                    </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row pt-0">
                    <div class="col col-12 mb-4">
                        <input type="hidden" name="groupIDStep3" id="groupIDStep3" value="0" class="input-group"
                               readonly>
                    </div>
                    <div class="col col-12 col-lg-6 mb-5">
                        <h6 class="card-title font-weight-bold mt-0 mb-4">
                            Estudiantes aun sin asignar al curso
                        </h6>
                        <div class="table-responsive">
                            <table class="table border table-sm" id="table-student-wog">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col"><small><strong>N°</strong></small></th>
                                    <th scope="col"><small><strong>Alumno</strong></small></th>
                                    <th scope="col"><small><strong>Programa</strong></small></th>
                                    <th scope="col"><small><strong>Puntaje</strong></small></th>
                                    <th scope="col"><small><strong>&nbsp;</strong></small></th>
                                </tr>
                                </thead>
                                <tbody id="tbody-student-wog">
                                <tr class="text-center">
                                    <th scope="row" colspan="5">Cargando...</th>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="col col-12 col-lg-6 mb-2">
                        <h6 class="card-title font-weight-bold mt-0">
                            Estudiantes para este grupo
                        </h6>
                        <small class="mb-4">
                            Se recomienda un número maximo de 40 estudiantes por grupo.
                            Actualmente hay <span id="countStudents">0</span> estudiantes en este grupo.
                        </small>

                        <div class="table-responsive mt-3">
                            <table class="table border table-sm" id="table-student-wg">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col"><small><strong>N°</strong></small></th>
                                    <th scope="col"><small><strong>Alumno</strong></small></th>
                                    <th scope="col"><small><strong>Programa</strong></small></th>
                                    <th scope="col"><small><strong>Puntaje</strong></small></th>
                                    <th scope="col"><small><strong>&nbsp;</strong></small></th>
                                </tr>
                                </thead>
                                <tbody id="tbody-student-wg">
                                <tr class="text-center">
                                    <th scope="row" colspan="5">Cargando...</th>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm">Guardar y finalizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Teachers -->
<div class="modal fade" id="modalTeacher" tabindex="-1" aria-labelledby="modalTeacher" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title font-weight-bold">Docentes disponibles</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-sm border" id="table-teachers">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col"><small><strong>N°</strong></small></th>
                        <th scope="col"><small><strong>DNI</strong></small></th>
                        <th scope="col"><small><strong>Nombre del docente</strong></small></th>
                        <th scope="col"><small><strong>Curso</strong></small></th>
                        <th scope="col"><small><strong>&nbsp;</strong></small></th>
                    </tr>
                    </thead>
                    <tbody id="tbody-teachers">
                    <tr>
                        <th scope="row" colspan="5" class="text-center">
                            <small>Cargando...</small>
                        </th>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Schedules -->
<div class="modal fade" data-backdrop="static" id="modalSchedule" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title font-weight-bold">Horario</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formSchedule">
                <div class="modal-body">
                    <input type="hidden" id="groupIDSchedule" name="groupIDSchedule" value="0" class="input-group"
                           readonly>
                    <div class="form-group">
                        <label for="day" class="col-form-label-sm">
                            Dia
                        </label>
                        <select id="day" name="day" class="form-control form-control-sm" required>
                            <option value="0">Selecciona...</option>
                            <option value="1">Lunes</option>
                            <option value="2">Martes</option>
                            <option value="3">Miercoles</option>
                            <option value="4">Jueves</option>
                            <option value="5">Viernes</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="rooms" class="col-form-label-sm">
                            Aula
                        </label>
                        <select name="rooms" id="rooms" class="form-control form-control-sm" required>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="time_start" class="col-form-label-sm">
                                    Hora de Inicio
                                </label>
                                <select id="time_start" name="time_start"
                                        class="custom-select form-control form-control-sm" required>
                                    <option value="08:00" selected>08:00</option>
                                    <option value="09:00">09:00</option>
                                    <option value="10:00">10:00</option>
                                </select>
                                <!--                        <input type="time" id="time_start" name="time_start" class="form-control form-control-sm"-->
                                <!--                               value="00:00" required>-->
                            </div>
                        </div>
                        <div class="col-6">

                            <div class="form-group">
                                <label for="time_end" class="col-form-label-sm">
                                    Hora de finalización
                                </label>

                                <select id="time_end" name="time_end" class="custom-select form-control form-control-sm"
                                        required>
                                    <option value="10:00">10:00</option>
                                    <option value="11:00">11:00</option>
                                    <option value="12:00" selected>12:00</option>
                                </select>
                                <!--                        <input type="time" id="time_end" name="time_end" class="form-control form-control-sm"-->
                                <!--                               value="00:00" required>-->

                            </div>
                        </div>
                    </div>

                    <small id="timeHelpBlock">
                    </small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
                    <button type="submit" id="saveSchedule" class="btn btn-primary btn-sm">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="public/js/components/SweetAlerts.js"></script>
<script src="public/js/components/Badge.js"></script>
<script src="public/js/components/Table.js"></script>
<script src="public/js/components/Select.js"></script>
<script src="public/js/components/Button.js"></script>
<script src="public/js/objects/Schedule.js"></script>
<script src="public/js/classroom.js"></script>
<script src="public/js/dates_validator.js"></script>

<?php
require_once COMPONENT_PATH . "downpart.php";
?>
