<?php
require_once 'dirs.php';
require_once UTIL_PATH . "sessions/SessionStarted.php";
session_start();
$sessionStarted = new SessionStarted();
$sessionStarted->verifySessionStarted();

require_once $sessionStarted->getUpperPartByUserType();
?>
<div class="container">


    <div class="d-flex justify-content-between">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalGroup">
            <i class="bi bi-plus mr-1"></i>Nuevo grupo de clases
        </button>
    </div>
    <!--   Table with groups-->
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title font-weight-bold mb-4">Grupos de clases asignadas</h5>
            <div class="table-responsive">
                <table class="table table-sm border" id="table-groups">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col"><small><strong>N°</strong></small></th>
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
    <div class="modal-dialog modal-sm" id="modalGroupSize">
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
                    <div class="form-group">
                        <label for="process" class="col-form-label-sm">
                            Proceso
                        </label>
                        <select name="process" id="process" class="form-control form-control-sm" required>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="area" class="col-form-label-sm">
                            Área
                        </label>
                        <select name="area" id="area" class="form-control form-control-sm" required>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="dimension" class="col-form-label-sm text-right">
                            Dimensión
                        </label>
                        <select name="dimension" id="dimension" class="form-control form-control-sm" required>
                            <option value="0">Seleccione</option>
                            <option value="2">Matematica</option>
                            <option value="3">Comunicacion</option>
                            <option value="7">Técnicas de Estudio</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date_start" class="col-form-label-sm text-right">
                            Fecha de inicio
                        </label>
                        <input type="date" id="date_start" name="date_start"
                               class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <label for="date_end" class="col-form-label col-form-label-sm text-right">
                            Fecha de fin
                        </label>
                        <input type="date" id="date_end" name="date_end"
                               class="form-control form-control-sm"
                               aria-describedby="dateHelpBlock" required>
                        <small id="dateHelpBlock" class="text-danger">
                            La duración debe ser de 2 semanas. Actualmente hay 0 dias de diferencia
                        </small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="ml-auto btn btn-light btn-sm mr-2" data-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary btn-sm">Crear grupo</button>
                </div>
            </form>
            <form id="formTeacher" class="d-none">
                <div class="modal-header">
                    <h6 class="modal-title font-weight-bold text-primary">
                        Paso 2:</br>
                        <small class="text-muted"> Información del docente y del aula</small>
                    </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <small>Este paso no es obligatorio, puede consignar esta información mas adelante</small>

                    <input type="text" id="groupIDStep2" name="groupIDStep2" value="0" class="input-group" readonly>

                    <input type="text" id="teacherID" name="teacherID" class="input-group" value="0" readonly>

                    <div class="form-group">
                        <label for="teacherName" class="col-form-label-sm">
                            Nombre del Docente
                        </label>
                        <input type="button" class="form-control form-control-sm" id="teacherName" data-toggle="modal"
                               data-target="#modalTeacher" readonly required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm">Guardar y siguiente</button>
                </div>
            </form>
            <form id="formScheduleToGroup" class="d-none">
                <div class="modal-header">
                    <h6 class="modal-title font-weight-bold text-primary">
                        Paso 3:</br>
                        <small class="text-muted"> Horarios</small>
                    </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <small>Este paso no es obligatorio, puede consignar esta información mas adelante</small>

                    <input type="text" id="groupIDStep3" value="0" class="input-group" readonly>
                    <button type="button" class="btn btn-light btn-sm my-2" id="openScheduleModal"
                            data-toggle="modal"
                            data-target="#modalSchedule">
                        <i class="bi bi-calendar-week mr-1"></i>Agregar horario
                    </button>
                    <div class="table-responsive">
                        <table class="table table-sm border">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col"><small><strong>Día</strong></small></th>
                                <th scope="col"><small><strong>Inicio</strong></small></th>
                                <th scope="col"><small><strong>Fin</strong></small></th>
                                <th scope="col"><small><strong>Horas</strong></small></th>
                                <th scope="col"><small><strong>&nbsp;</strong></small></th>
                            </tr>
                            </thead>
                            <tbody id="tbody-schedule">
                            </tbody>
                            <tfoot>
                            <tr>
                                <th scope="col"><small><strong>Total</strong></small></th>
                                <th scope="col" colspan="2"><small><strong>&nbsp;</strong></small></th>
                                <th scope="col" colspan="2">
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
                <div class="modal-header">
                    <h6 class="modal-title font-weight-bold text-primary">
                        Paso 4:</br>
                        <small class="text-muted"> Estudiantes</small>
                    </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row">
                    <small>Este paso no es obligatorio, puede consignar esta información mas adelante</small>

                    <input type="text" id="groupIDStep4" value="0" class="input-group" readonly>
                    <div class="col col-12 col-lg-6 mb-2">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title font-weight-bold mt-0 mb-4">
                                    Estudiantes aun sin asignar al curso
                                </h6>


                                <table class="table table-bordered table-sm">
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col"><small><strong>N°</strong></small></th>
                                        <th scope="col"><small><strong>Alumno</strong></small></th>
                                        <th scope="col"><small><strong>Programa</strong></small></th>
                                        <th scope="col"><small><strong>Puntaje</strong></small></th>
                                        <th scope="col"><small><strong>&nbsp;</strong></small></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Larry</td>
                                        <td>the Bird</td>
                                        <td>@twitter</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col col-12 col-lg-6 mb-2">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title font-weight-bold mt-0 mb-4">
                                    Estudiantes para este grupo
                                </h6>
                                <table class="table table-bordered table-sm">
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col"><small><strong>N°</strong></small></th>
                                        <th scope="col"><small><strong>Name</strong></small></th>
                                        <th scope="col"><small><strong>Lastname</strong></small></th>
                                        <th scope="col"><small><strong>Portrain</strong></small></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
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
                    <div class="form-group">
                        <label for="day" class="col-form-label-sm">
                            Dia
                        </label>
                        <select id="day" name="day" class="form-control form-control-sm" required>
                            <option>Lunes</option>
                            <option>Martes</option>
                            <option>Miercoles</option>
                            <option>Jueves</option>
                            <option>Viernes</option>
                            <option>Sabado</option>
                            <option>Domingo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="rooms" class="col-form-label-sm">
                            Aula
                        </label>
                        <select name="rooms" id="rooms" class="form-control form-control-sm" required>
                            <option value="0">Seleccione</option>
                            <option value="0">N-400</option>
                            <option value="0">N-401</option>
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
                                    <option value="07:00">07:00</option>
                                    <option value="08:00">08:00</option>
                                    <option value="09:00">09:00</option>
                                    <option value="10:00">10:00</option>
                                    <option value="11:00">11:00</option>
                                    <option value="12:00">12:00</option>
                                    <option value="13:00">13:00</option>
                                    <option value="14:00">14:00</option>
                                    <option value="15:00">15:00</option>
                                    <option value="16:00">16:00</option>
                                    <option value="17:00">17:00</option>
                                    <option value="18:00">18:00</option>
                                    <option value="19:00">19:00</option>
                                    <option value="20:00">20:00</option>
                                    <option value="21:00">21:00</option>
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
                                    <option value="09:00">09:00</option>
                                    <option value="10:00">10:00</option>
                                    <option value="11:00">11:00</option>
                                    <option value="12:00">12:00</option>
                                    <option value="13:00">13:00</option>
                                    <option value="14:00">14:00</option>
                                    <option value="15:00">15:00</option>
                                    <option value="16:00">16:00</option>
                                    <option value="17:00">17:00</option>
                                    <option value="18:00">18:00</option>
                                    <option value="19:00">19:00</option>
                                    <option value="20:00">20:00</option>
                                    <option value="21:00">21:00</option>
                                    <option value="22:00">22:00</option>
                                    <option value="23:00">23:00</option>
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
                    <button type="submit" id="saveSchedule" class="btn btn-primary btn-sm" disabled="true">
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
