<?php
require_once 'dirs.php';
require_once UTIL_PATH . "sessions/SessionStarted.php";
session_start();
$sessionStarted = new SessionStarted();
$sessionStarted->verifySessionStarted();

require_once $sessionStarted->getUpperPartByUserType();
?>
    <div class="container">

        <div class="row my-3" id="card-areas">
            <!--            Las areas se cargan dinamicamente con JS-->
        </div>

        <div class="row my-3">
            <div class="col col-12 col-lg-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        Programas Académicos del Área <span class="font-weight-bold" id="areaNameSchool"></span>
                    </div>
                    <div class="card-body" id="card-body-school">
                        <button type="button" class="btn btn-primary btn-sm mb-4" data-toggle="modal"
                                data-target="#SchoolModal" id="newSchool">
                            Agregar nuevo Programa Académico
                        </button>
                        <table class="table table-bordered table-sm mt-4" id="table-schools">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col"><small><strong>N°</strong></small></th>
                                <th scope="col"><small><strong>Programa Académico</strong></small></th>
                            </tr>
                            </thead>
                            <tbody id="tbody-schools">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col col-12 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        Cursos del Área <span class="font-weight-bold" id="areaNameCourse"></span>
                    </div>
                    <div class="card-body" id="card-body-school">
                        <button type="button" class="btn btn-primary btn-sm mb-4" data-toggle="modal"
                                data-target="#CoursesModal" id="addCourse">
                            Agregar nuevo curso
                        </button>
                        <table class="table table-bordered table-sm mt-4" id="table-courses">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col" style="width: 5%;"><small><strong>N°</strong></small></th>
                                <th scope="col" style="width: 60%;"><small><strong>Curso</strong></small></th>
                                <th scope="col" style="width: 10%;"><small><strong>Proceso</strong></small></th>
                            </tr>
                            </thead>
                            <tbody id="tbody-courses">
                            </tbody>
                        </table>

                        <div class="alert alert-info my-2" role="alert">
                            <div class="row">
                                <div class="col col-1">
                                    <h2>
                                        <i class="bi bi-info-circle-fill"></i>
                                    </h2>
                                </div>
                                <div class="col col-11">
                                    <small>
                                        <ul>
                                            <li>Para ver y modificar los rangos de cada curso
                                                <a href="rangos">pulse aqui</a>.
                                            </li>
                                            <li>Para añadir nuevos cursos
                                                <a href="cursos">pulse aqui</a>.
                                            </li>
                                        </ul>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Areas Modal-->
        <div class="modal fade" data-backdrop="static" id="add-area" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form id="form-area">
                            <div class="form-group">
                                <label for="area" class="col-form-label col-form-label-sm">Ingrese abreviatura del
                                    area:</label>
                                <input type="text" name="area" class="form-control form-control-user form-control-sm"
                                       id="area" required
                                       placeholder="Ej. A">
                                <label for="desc" class="col-form-label col-form-label-sm">Ingrese descripcion del
                                    area:</label>
                                <input type="text" name="desc" class="form-control form-control-user form-control-sm"
                                       id="desc" required
                                       placeholder="Ej. Ciencias e Ingenieria">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-light btn-sm" type="button" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Programs Modal -->
        <div class="modal fade" id="SchoolModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
             aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <form id="form-schools">
                            <div class="form-group">
                                <input id="areaIDSch" value="0" name="areaIDSch" type="hidden"/>
                                <label for="school" class="col-form-label col-form-label-sm">Nombre del Programa
                                    Académico</label>
                                <input type="text" class="form-control form-control-sm" id="school" name="school"
                                       placeholder="Ej. Turismo" required>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Courses Modal -->
        <div class="modal fade" id="CoursesModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
             aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <form id="form-courses">
                            <input id="areaIDCou" value="0" name="areaIDCou" type="hidden"/>
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="cbCourses" class="col-form-label col-form-label-sm">Curso que aun no
                                            estan registrados</label>
                                        <select name="courses" id="cbCourses" class="form-control form-control-sm"
                                                aria-describedby="courseHelp" required></select>
                                        <small id="courseHelp" class="form-text text-muted">Los cursos que se muestran
                                            son los que aun no estan registrados en el area.</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="min" class="col-form-label col-form-label-sm">Rango Minimo
                                            (%)</label>
                                        <input name="min" type="number" class="form-control form-control-sm" id="min"
                                               value="50"
                                               required
                                               max="100" min="0">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="max" class="col-form-label col-form-label-sm">Rango Recomendado
                                            (%)</label>
                                        <input name="max" type="number" class="form-control form-control-sm" id="max"
                                               value="70"
                                               required
                                               max="100" min="0">
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="public/js/components/Button.js"></script>
    <script src="public/js/components/Card.js"></script>
    <script src="public/js/components/Table.js"></script>
    <script src="public/js/components/Column.js"></script>
    <script src="public/js/components/CardArea.js"></script>
    <script src="public/js/area.js"></script>
<?php
require_once COMPONENT_PATH . "downpart.php";
?>