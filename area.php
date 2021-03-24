<?php
session_start();
require_once "app/components/upperpart.php";
?>


    <!-- Begin Page Content -->
    <div class="container">

        <!-- Page Heading -->
        <h1 class="h3 mb-0 text-gray-800">Areas</h1>

        <div class="row my-3" id="card-areas">

        </div>

        <div class="row my-3">
            <div class="col col-md-12 col-lg-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        Escuelas del area <span class="font-weight-bold" id="areaNameSchool"></span>
                    </div>
                    <div class="card-body" id="card-body-school">
                        <button type="button" class="btn btn-primary mb-3" data-toggle="modal"
                                data-target="#SchoolModal" id="newSchool">
                            Agregar nueva escuela
                        </button>
                        <table class="table" id="table-schools">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Escuela</th>
                            </tr>
                            </thead>
                            <tbody id="tbody-schools">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col col-md-12 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        Cursos del area <span class="font-weight-bold" id="areaNameCourse"></span>
                    </div>
                    <div class="card-body" id="card-body-school">
                        <button type="button" class="btn btn-primary mb-3" data-toggle="modal"
                                data-target="#CoursesModal" id="newCourse">
                            Agregar nuevo curso
                        </button>
                        <span class="badge badge-danger">Aun falta</span>
                        <table class="table" id="table-courses">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Curso</th>
                                <th scope="col">Proceso</th>
                            </tr>
                            </thead>
                            <tbody id="tbody-courses">
                            </tbody>
                        </table>

                        <div class="alert alert-info my-2" role="alert">
                            <ul>
                                <li>Para ver y modificar los rangos de cada curso
                                    <a href="http://localhost/nivelation/rangevalues.php">pulse aqui</a>
                                </li>
                                <li>Para añadir nuevos cursos
                                    <a href="http://localhost/nivelation/rangevalues.php">pulse aqui</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Areas Modal-->
        <div class="modal fade" id="add-area" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Crear nueva área</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form-area">
                            <div class="form-group">
                                <label for="area" class="col-form-label-sm">Ingrese abreviatura del area:</label>
                                <input type="text" name="area" class="form-control form-control-user" id="area"
                                       placeholder="A">
                                <label for="desc" class="col-form-label-sm">Ingrese descripcion del area:</label>
                                <input type="text" name="desc" class="form-control form-control-user" id="desc"
                                       placeholder="Ciencias e Ingenieria">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-light" type="button" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Schools Modal -->
        <div class="modal fade" id="SchoolModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
             aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Agregar nueva escuela</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form-schools">
                            <div class="form-group">
                                <input id="areaIDSch" value="0" name="areaIDSch" type="text"/>
                                <label for="school">Nombre de la escuela</label>
                                <input type="text" class="form-control" id="school" name="school" required>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
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
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Agregar nuevo curso</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Understood</button>
                    </div>
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
require_once "app/components/downpart.php";
?>