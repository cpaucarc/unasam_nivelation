<?php
require_once "app/components/upperpart.php";
?>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="d-flex bd-highlight mb-3">
                    <div class="p-2 bd-highlight">
                        <label for="area">Area</label>
                        <select class="form-control" id="area">
                            <option value="0">Selecciona...</option>
                            <option value="1">A</option>
                            <option value="2">B</option>
                            <option value="3">C</option>
                            <option value="4">D</option>
                            <option value="5">E</option>
                        </select>
                    </div>
                    <div class="ml-auto p-2 bd-highlight">
                        <label for="process">Proceso de Admisión</label>
                        <select class="form-control" id="process">
                            <option value="0">Selecciona...</option>
                            <option value="5">2020-II</option>
                            <option value="4">2021-I</option>
                            <option value="3">2019-II</option>
                            <option value="2">2019-I</option>
                            <option value="6">2022-II</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title">Rango de Valores del Area
                    <span id="selectedArea" class="font-weight-bold">A</span> en el proceso
                    <span id="selectedProcess" class="font-weight-bold">2019-II</span>
                </h5>
                <!--Botones-->
                <div class="my-4">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-rank">
                        Registrar nuevo
                    </button>
                </div>
                <!--Tabla-->
                <table class="table mt-2" id="table-ranks">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Curso</th>
                        <th scope="col">Area</th>
                        <th scope="col">Proceso</th>
                        <th scope="col">Minimo</th>
                        <th scope="col">Maximo</th>
                        <th scope="col">Acción</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">

                    </tbody>
                </table>

                <!--                Informacion con fondo azul-->
                <div class="my-4">
                    <div class="alert alert-info">
                        <p class="card-text">
                            Los alumnos con:
                        <ul>
                            <li>Aciertos menor al minimo requerido, requieren nivelación obligatoria.</li>
                            <li>Aciertos entre el minimo y el maximo, pueden tomar nivelación pero no obligatoria.</li>
                            <li>Aciertos mayor al maximo requerido, no deben tomar nivelación.</li>
                        </ul>
                        </p>
                    </div>
                </div>

                <!--                Modal-->
                <div class="modal fade" id="modal-rank" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- /.container-fluid -->
    <script src="public/js/components/Table.js"></script>
    <script src="public/js/components/Button.js"></script>
    <script src="public/js/ranks.js"></script>

<?php
require_once "app/components/downpart.php";
?>