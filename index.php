<?php
require_once 'dirs.php';
require_once UTIL_PATH . "sessions/SessionStarted.php";
session_start();
$sessionStarted = new SessionStarted();
$sessionStarted->verifySessionStarted();

require_once $sessionStarted->getUpperPartByUserType();

if (intval($_SESSION['user_logged']['utid']) === 1) {
    ?>

    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-9">
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="row d-flex justify-content-around">
                            <div class="col col-12 col-lg-7 mb-4">
                                <label for="lastProcess" class="col-form-label col-form-label-sm">Proceso de
                                    Admision</label>
                                <h3 class="font-weight-bold text-primary" aria-describedby="help">
                                    <i class="bi bi-calendar-check mr-2"></i> <span id="lastProcess">Cargando...</span>
                                </h3>
                                <small id="help" class="form-text text-muted">
                                    Los datos que cargue ahora se guardaran para este proceso de admisión.
                                    Puede añadir un nuevo proceso entrando a <a href="admision">esta pagina</a>
                                </small>
                            </div>
                            <div class="col col-12 col-lg-4 my-auto">
                                <button class="btn btn-primary btn-block" data-toggle="modal"
                                        data-target="#file_modal">
                                    <i class="bi bi-upload mr-2"></i>Subir documento
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="file_modal" data-backdrop="static" data-keyboard="false" tabindex="-1"
         aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <a class="btn btn-light btn-sm" data-toggle="collapse" href="#collapseExample"
                       role="button"
                       aria-expanded="false" aria-controls="collapseExample">
                        <span id="courses-icon"></span>
                    </a>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </br>
                </div>
                <div class="modal-body pt-0">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <div class="collapse mt-2" id="collapseExample">
                                <div class="card card-body">
                                    <small>
                                        <ul class="mb-0 pl-3" id="missing-courses">
                                        </ul>
                                    </small>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div id="file-form" class="col-12">
                            <form id="upload_form" enctype="multipart/form-data">
                                <div class="col-12">
                                    <div class="row border p-2 d-flex align-items-end">
                                        <div class="col-1 d-flex justify-content-center">
                                            <h2 class="mb-4" id="file-icon">
                                                <i class="bi bi-question-square"></i>
                                            </h2>
                                        </div>
                                        <div class="col-11">
                                            <div class="form-group">
                                                <label for="file"
                                                       class="col-form-label col-form-label-sm mb-1">Adjunto</label>
                                                <input type="file" class="form-control-file" name="file" id="file"
                                                       accept=".xls, .xlsx" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end my-3 pr-0">
                                    <button type="button" class="btn btn-light btn-sm mr-2" data-toggle="modal"
                                            data-target="#exampleModal" id="preview" disabled>
                                        <i class="bi bi-table mr-2"></i>Vista previa
                                    </button>
                                    <button type="submit" class="btn btn-primary btn-sm" id="btn_upload" disabled>
                                        <i class="bi bi-server mr-2"></i>Guardar y clasificar datos
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="alert alert-info mb-0 w-100" role="alert">
                        <small class="mb-0">
                            Verifique que los datos que se muestran en esta vista previa se corresponde al
                            archivo de excel que desea subir. Si hubiera variaciones, modifique su archivo excel.
                        </small>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-sm">
                        <thead class="thead-light">
                        <tr>
                            <th><small><strong>Nro</strong></small></th>
                            <th><small><strong>DNI</strong></small></th>
                            <th><small><strong>CodigoPos</strong></small></th>
                            <th><small><strong>CodigoUni</strong></small></th>
                            <th><small><strong>Apellidos</strong></small></th>
                            <th><small><strong>Nombres</strong></small></th>
                            <th><small><strong>Sexo</strong></small></th>
                            <th><small><strong>Area</strong></small></th>
                            <th><small><strong>Carrera</strong></small></th>
                            <th><small><strong>OMG</strong></small></th>
                            <th><small><strong>P1</strong></small></th>
                            <th><small><strong>P2</strong></small></th>
                            <th><small><strong>P3</strong></small></th>
                            <th><small><strong>P4</strong></small></th>
                            <th><small><strong>P5</strong></small></th>
                            <th><small><strong>P6</strong></small></th>
                            <th><small><strong>P7</strong></small></th>
                            <th><small><strong>P8</strong></small></th>
                            <th><small><strong>P9</strong></small></th>
                            <th><small><strong>P10</strong></small></th>
                            <th><small><strong>P11</strong></small></th>
                            <th><small><strong>P12</strong></small></th>
                            <th><small><strong>P13</strong></small></th>
                            <th><small><strong>P14</strong></small></th>
                            <th><small><strong>P15</strong></small></th>
                            <th><small><strong>P16</strong></small></th>
                            <th><small><strong>P17</strong></small></th>
                            <th><small><strong>P18</strong></small></th>
                            <th><small><strong>P19</strong></small></th>
                            <th><small><strong>P20</strong></small></th>
                            <th><small><strong>P21</strong></small></th>
                            <th><small><strong>P22</strong></small></th>
                            <th><small><strong>P23</strong></small></th>
                            <th><small><strong>P24</strong></small></th>
                            <th><small><strong>P25</strong></small></th>
                            <th><small><strong>P26</strong></small></th>
                            <th><small><strong>P27</strong></small></th>
                            <th><small><strong>P28</strong></small></th>
                            <th><small><strong>P29</strong></small></th>
                            <th><small><strong>P30</strong></small></th>
                            <th><small><strong>P31</strong></small></th>
                            <th><small><strong>P32</strong></small></th>
                            <th><small><strong>P33</strong></small></th>
                            <th><small><strong>P34</strong></small></th>
                            <th><small><strong>P35</strong></small></th>
                            <th><small><strong>P36</strong></small></th>
                            <th><small><strong>P37</strong></small></th>
                            <th><small><strong>P38</strong></small></th>
                            <th><small><strong>P39</strong></small></th>
                            <th><small><strong>P40</strong></small></th>
                            <th><small><strong>P41</strong></small></th>
                            <th><small><strong>P42</strong></small></th>
                            <th><small><strong>P43</strong></small></th>
                            <th><small><strong>P44</strong></small></th>
                            <th><small><strong>P45</strong></small></th>
                            <th><small><strong>P46</strong></small></th>
                            <th><small><strong>P47</strong></small></th>
                            <th><small><strong>P48</strong></small></th>
                            <th><small><strong>P49</strong></small></th>
                            <th><small><strong>P50</strong></small></th>
                            <th><small><strong>P51</strong></small></th>
                            <th><small><strong>P52</strong></small></th>
                            <th><small><strong>P53</strong></small></th>
                            <th><small><strong>P54</strong></small></th>
                            <th><small><strong>P55</strong></small></th>
                            <th><small><strong>P56</strong></small></th>
                            <th><small><strong>P57</strong></small></th>
                            <th><small><strong>P58</strong></small></th>
                            <th><small><strong>P59</strong></small></th>
                            <th><small><strong>P60</strong></small></th>
                            <th><small><strong>P61</strong></small></th>
                            <th><small><strong>P62</strong></small></th>
                            <th><small><strong>P63</strong></small></th>
                            <th><small><strong>P64</strong></small></th>
                            <th><small><strong>P65</strong></small></th>
                            <th><small><strong>P66</strong></small></th>
                            <th><small><strong>P67</strong></small></th>
                            <th><small><strong>P68</strong></small></th>
                            <th><small><strong>P69</strong></small></th>
                            <th><small><strong>P70</strong></small></th>
                            <th><small><strong>P71</strong></small></th>
                            <th><small><strong>P72</strong></small></th>
                            <th><small><strong>P73</strong></small></th>
                            <th><small><strong>P74</strong></small></th>
                            <th><small><strong>P75</strong></small></th>
                            <th><small><strong>P76</strong></small></th>
                            <th><small><strong>P77</strong></small></th>
                            <th><small><strong>P78</strong></small></th>
                            <th><small><strong>P79</strong></small></th>
                            <th><small><strong>P80</strong></small></th>
                            <th><small><strong>P81</strong></small></th>
                            <th><small><strong>P82</strong></small></th>
                            <th><small><strong>P83</strong></small></th>
                            <th><small><strong>P84</strong></small></th>
                            <th><small><strong>P85</strong></small></th>
                            <th><small><strong>P86</strong></small></th>
                            <th><small><strong>P87</strong></small></th>
                            <th><small><strong>P88</strong></small></th>
                            <th><small><strong>P89</strong></small></th>
                            <th><small><strong>P90</strong></small></th>
                            <th><small><strong>P91</strong></small></th>
                            <th><small><strong>P92</strong></small></th>
                            <th><small><strong>P93</strong></small></th>
                            <th><small><strong>P94</strong></small></th>
                            <th><small><strong>P95</strong></small></th>
                            <th><small><strong>P96</strong></small></th>
                            <th><small><strong>P97</strong></small></th>
                            <th><small><strong>P98</strong></small></th>
                            <th><small><strong>P99</strong></small></th>
                            <th><small><strong>P100</strong></small></th>
                            <th><small><strong>Puntaje</strong></small></th>
                            <th><small><strong>Blanco</strong></small></th>
                            <th><small><strong>Buena</strong></small></th>
                            <th><small><strong>Mala</strong></small></th>
                        </tr>
                        </thead>
                        <tbody id="tbody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="public/js/components/SweetAlerts.js"></script>
    <script src="public/js/index.js"></script>

<?php } else { ?>

    <div class="container-fluid">
        <div class="text-center mb-3">
            <h3 class="font-weight-lighter">Bienvenido
                <span class="text-primary font-weight-bold">
                <?php echo($_SESSION['user_logged']['lastname'] . ' ' . $_SESSION['user_logged']['name']); ?>
            </span>
            </h3>
            <small class="text-gray-600">
                Este es el sistema de nivelación para ingresantes, explore y use todas las funcionalidades que ofrece el
                sistema.
            </small>
        </div>

        <div class="d-flex justify-content-center">
            <img src="public/images/welcome.svg" class="w-50 p-5" alt="imagen de bienvenida" loading="lazy">
        </div>
    </div>

    <script>
        window.addEventListener('load', () => {
            document.getElementById('view-title').innerText = 'Inicio del Sitio';
        });
    </script>
    <?php
}
@include_once "app/components/downpart.php";
?>