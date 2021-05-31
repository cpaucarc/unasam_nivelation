<?php
require_once "dirs.php";
require_once UTIL_PATH . "sessions/SessionStarted.php";
session_start();
$sessionStarted = new SessionStarted();
$sessionStarted->verifySessionStarted();

require_once $sessionStarted->getUpperPartByUserType();
?>
    <div class="container">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex bd-highlight mb-3">
                    <div class="ml-auto bd-highlight mr-4">
                        <label for="process" class="col-form-label col-form-label-sm">Proceso de Admisión</label>
                        <select class="form-control form-control-sm" id="process">
                            <option value="0">Selecciona...</option>
                        </select>
                    </div>
                    <div class="bd-highlight">
                        <label class="col-form-label col-form-label-sm mr-2" for="area">Área:</label>
                        <select class="form-control form-control-sm mr-sm-2" id="area">
                            <option value="1">A</option>
                            <option value="2">B</option>
                            <option value="3">C</option>
                            <option value="4">D</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="card">
                    <div class="card-header pt-3 pb-0 px-3">
                        <ul class="nav nav-tabs border-bottom-0 text-muted">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#for_courses">Valores para cursos</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#for_dimensions">Valores
                                    para dimensiones</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <!--Panel 1-->
                            <div class="tab-pane fade in show active" id="for_courses" role="tabpanel">
                                <!--Tabla-->
                                <div class="table-responsive">
                                    <table class="table table-sm table-striped border mt-2" id="table-ranks">
                                        <thead class="thead-light">
                                        <tr>
                                            <th scope="col"><small><strong>N°</strong></small></th>
                                            <th scope="col"><small><strong>Área</strong></small></th>
                                            <th scope="col"><small><strong>Proceso</strong></small></th>
                                            <th scope="col"><small><strong>Curso</strong></small></th>
                                            <th scope="col"><small><strong>Minimo (%)</strong></small></th>
                                            <th scope="col"><small><strong>Recomendado (%)</strong></small></th>
                                            <th scope="col"><small><strong>&nbsp;</strong></small></th>
                                        </tr>
                                        </thead>
                                        <tbody id="tbody">

                                        </tbody>
                                    </table>
                                </div>
                                <!--                Informacion con fondo azul-->
                                <div class="mt-3">
                                    <div class="alert alert-info mb-0 py-2">
                                        <div class="row">
                                            <div class="col col-1">
                                                <h2>
                                                    <i class="bi bi-info-circle-fill"></i>
                                                </h2>
                                            </div>
                                            <div class="col col-11">
                                                <small class="card-text mb-2">
                                                    Los alumnos con:
                                                </small>
                                                <ul class="mb-0">
                                                    <li>
                                                        <small>
                                                            Aciertos menor al minimo requerido, requieren nivelación
                                                            obligatoria.
                                                        </small>
                                                    </li>
                                                    <li>
                                                        <small>
                                                            Aciertos entre el minimo y el maximo, pueden tomar
                                                            nivelación pero no obligatoria.
                                                        </small>
                                                    </li>
                                                    <li>
                                                        <small>
                                                            Aciertos mayor al maximo requerido, no deben tomar
                                                            nivelación.
                                                        </small>
                                                    </li>
                                                </ul>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--Panel 2-->
                            <div class="tab-pane fade" id="for_dimensions" role="tabpanel">
                                <!--Tabla-->
                                <div class="table-responsive">
                                    <table class="table table-sm table-striped border mt-2" id="table-dimension-ranks">
                                        <thead class="thead-light">
                                        <tr>
                                            <th scope="col"><small><strong>N°</strong></small></th>
                                            <th scope="col"><small><strong>Área</strong></small></th>
                                            <th scope="col"><small><strong>Proceso</strong></small></th>
                                            <th scope="col"><small><strong>Dimensión</strong></small></th>
                                            <th scope="col"><small><strong>Minimo (%)</strong></small></th>
                                            <th scope="col"><small><strong>&nbsp;</strong></small></th>
                                        </tr>
                                        </thead>
                                        <tbody id="tbody-dimension-ranks">
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal fade" data-backdrop="static" id="modal-rank" tabindex="-1"
                     aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm">
                        <div class="modal-content">
                            <form id="form-rank">
                                <div class="modal-body">
                                    <input type="hidden" value="0" id="rankID" name="rankID">
                                    <div class="form-group">
                                        <label for="txCourse" class="col-form-label col-form-label-sm">Curso</label>
                                        <input type="text" class="form-control form-control-sm" id="txCourse"
                                               name="txCourse" disabled>
                                    </div>
                                    <div class="row">
                                        <div class="col col-6">
                                            <div class="form-group">
                                                <label for="txMin" class="col-form-label col-form-label-sm">Puntaje
                                                    Minimo</label>
                                                <input type="number" min="0" max="100"
                                                       class="form-control form-control-sm"
                                                       id="txMin" name="txMin">
                                            </div>
                                        </div>
                                        <div class="col col-6">
                                            <div class="form-group">
                                                <label for="txMax" class="col-form-label col-form-label-sm">Puntaje
                                                    Optimo</label>
                                                <input type="number" min="0" max="100"
                                                       class="form-control form-control-sm"
                                                       id="txMax" name="txMax">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar
                                    </button>
                                    <button type="submit" class="btn btn-primary btn-sm">Guardar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade" data-backdrop="static" id="modal-rank-dimension" tabindex="-1"
                     aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm">
                        <div class="modal-content">
                            <form id="form-rank-dimension">
                                <div class="modal-body">
                                    <input type="hidden" id="rankDimensionID" name="rankDimensionID" readonly>
                                    <div class="form-group">
                                        <label for="dimension"
                                               class="col-form-label col-form-label-sm">Dimensión</label>
                                        <input type="text" class="form-control form-control-sm" id="dimension"
                                               name="dimension" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="min" class="col-form-label col-form-label-sm">Puntaje
                                            Minimo</label>
                                        <input type="number" min="0" max="100"
                                               class="form-control form-control-sm"
                                               id="min" name="min">
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar
                                    </button>
                                    <button type="submit" class="btn btn-primary btn-sm">Guardar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /.container-fluid -->
    <script src="public/js/components/SweetAlerts.js"></script>
    <script src="public/js/components/Table.js"></script>
    <script src="public/js/components/Button.js"></script>
    <script src="public/js/components/Select.js"></script>
    <script src="public/js/ranks.js"></script>

<?php
require_once COMPONENT_PATH . "downpart.php";
?>