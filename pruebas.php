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
            <div class="card-header">
                <div class="d-flex bd-highlight mb-3">
                    <div class="bd-highlight">
                        <label for="area" class="col-form-label col-form-label-sm">Area</label>
                        <select class="form-control form-control-sm" id="area">
                            <option value="0">Selecciona...</option>
                            <option value="1">A</option>
                            <option value="2">B</option>
                            <option value="3">C</option>
                            <option value="4">D</option>
                        </select>
                    </div>
                    <div class="ml-auto bd-highlight">
                        <label for="process" class="col-form-label col-form-label-sm">Proceso de Admisión</label>
                        <select class="form-control form-control-sm" id="process">
                            <option value="0">Selecciona...</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title text-primary mb-3">Rango de Valores del Area
                    <span id="selectedArea" class="font-weight-bold">?</span> en el proceso
                    <span id="selectedProcess" class="font-weight-bold">?</span>
                </h5>

                <ul class="nav nav-tabs">
                    <li class="nav-item btn-sm">
                        <a class="nav-link active" data-toggle="tab" href="#panel11" role="tab">Active</a>
                    </li>
                    <li class="nav-item btn-sm">
                        <a class="nav-link" data-toggle="tab" href="#panel12" role="tab">Link</a>
                    </li>
                    <li class="nav-item btn-sm">
                        <a class="nav-link" data-toggle="tab" href="#panel13" role="tab">Link</a>
                    </li>
                    <li class="nav-item btn-sm">
                        <a class="nav-link" data-toggle="tab" href="#panel14" role="tab">Help</a>
                    </li>
                </ul>

                <!-- Tab panels -->
                <div class="tab-content border rounded p-3 mt-2">

                    <!--Panel 1-->
                    <div class="tab-pane fade in show active" id="panel11" role="tabpanel">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil odit magnam minima, soluta
                            doloribus
                            reiciendis molestiae placeat unde eos molestias. Quisquam aperiam, pariatur. Tempora,
                            placeat ratione
                            porro voluptate odit minima.</p>

                    </div>
                    <!--/.Panel 1-->

                    <!--Panel 2-->
                    <div class="tab-pane fade" id="panel12" role="tabpanel">
                        <br>

                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil odit magnam minima, soluta
                            doloribus
                            reiciendis molestiae placeat unde eos molestias. Quisquam aperiam, pariatur. Tempora,
                            placeat ratione
                            porro voluptate odit minima.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil odit magnam minima, soluta
                            doloribus
                            reiciendis molestiae placeat unde eos molestias. Quisquam aperiam, pariatur. Tempora,
                            placeat ratione
                            porro voluptate odit minima.</p>

                    </div>
                    <!--/.Panel 2-->

                    <!--Panel 3-->
                    <div class="tab-pane fade" id="panel13" role="tabpanel">
                        <br>

                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil odit magnam minima, soluta
                            doloribus
                            reiciendis molestiae placeat unde eos molestias. Quisquam aperiam, pariatur. Tempora,
                            placeat ratione
                            porro voluptate odit minima.</p>

                    </div>
                    <!--/.Panel 3-->

                    <!--Panel 4-->
                    <div class="tab-pane fade" id="panel14" role="tabpanel">
                        <br>

                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil odit magnam minima, soluta
                            doloribus
                            reiciendis molestiae placeat unde eos molestias. Quisquam aperiam, pariatur. Tempora,
                            placeat ratione
                            porro voluptate odit minima.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil odit magnam minima, soluta
                            doloribus
                            reiciendis molestiae placeat unde eos molestias. Quisquam aperiam, pariatur. Tempora,
                            placeat ratione
                            porro voluptate odit minima.</p>

                    </div>
                </div>


                <!--Tabla-->
                <div class="table-responsive">
                    <table class="table table-sm table-bordered mt-2" id="table-ranks">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col"><small><strong>N°</strong></small></th>
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
                <div class="my-4">
                    <div class="alert alert-info">
                        <div class="row">
                            <div class="col col-1">
                                <h2>
                                    <i class="bi bi-info-circle-fill"></i>
                                </h2>
                            </div>
                            <div class="col col-11">
                                <small>
                                    <p class="card-text">
                                        Los alumnos con:
                                    <ul>
                                        <li>Aciertos menor al minimo requerido, requieren nivelación obligatoria.</li>
                                        <li>Aciertos entre el minimo y el maximo, pueden tomar nivelación pero no
                                            obligatoria.
                                        </li>
                                        <li>Aciertos mayor al maximo requerido, no deben tomar nivelación.</li>
                                    </ul>
                                    </p>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" data-backdrop="static" id="modal-rank" tabindex="-1"
                     aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form id="form-rank">
                                <div class="modal-body">
                                    <input type="hidden" value="0" id="rankID" name="rankID">
                                    <div class="form-group">
                                        <label for="txCourse" class="col-form-label col-form-label-sm">Cursos</label>
                                        <input type="text" class="form-control form-control-sm" id="txCourse"
                                               name="txCourse" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="txMin" class="col-form-label col-form-label-sm">Puntaje
                                            Minimo</label>
                                        <input type="number" min="0" max="100" class="form-control form-control-sm"
                                               id="txMin" name="txMin">
                                    </div>
                                    <div class="form-group">
                                        <label for="txMax" class="col-form-label col-form-label-sm">Puntaje
                                            Optimo</label>
                                        <input type="number" min="0" max="100" class="form-control form-control-sm"
                                               id="txMax" name="txMax">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar
                                    </button>
                                    <button type="submit" class="btn btn-primary btn-sm" id="btnSubmitForm">Guardar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


<?php
require_once COMPONENT_PATH . "downpart.php";
?>