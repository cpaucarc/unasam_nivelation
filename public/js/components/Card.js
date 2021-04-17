class Card {
    constructor() {
    }

    getStudentInfoCard(stdLastname, stdName, stdSchool, stdDni, stdCode, stdProcess) {
        return `
            <div class="card bg-light">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">Datos del alumno</h6>
                </div>
                <div class="card-body">
                    <div class="col col-12 text-primary form-inline">
                        <h4 class="text-uppercase font-weight-bold">${stdLastname}</h4>&nbsp;
                        <h4 class="text-capitalize">${stdName}</h4>
                    </div>

                    <div class="col col-12 mt-4 form-inline">
                        <span class="font-weight-bold">Escuela:</span>&nbsp;
                        <span>${stdSchool}</span>
                    </div>
                    <div class="col col-12 mt-2 form-inline">
                        <span class="font-weight-bold">Admision de Ingreso:</span>&nbsp;
                        <span>${stdProcess}</span>
                    </div>
                    <div class="col col-12 mt-2 form-inline">
                        <span class="font-weight-bold">DNI:</span>&nbsp;
                        <span>${stdDni}</span>
                    </div>
                    <div class="col col-12 mt-2 form-inline">
                        <span class="font-weight-bold">Código:</span>&nbsp;
                        <span>${stdCode}</span>
                    </div>                    
                </div>
            </div>
            `;
    }

    getNotStudentSelectedCard() {
        return `<div class="alert alert-danger" role="alert">
            <div class="row">
                <div class="col col-2">
                    <i class="fa fa-info-circle fa-2x" aria-hidden="true"></i>
                </div>
                <div class="col col-10">
                    <h4 class="font-weight-bold">Atención:</h4>
                    <p>No se especificó el nombre del alumno. Use la barra de busqueda</p>
                </div>
            </div>
        </div>`;

    }

    getAddNewAreaCard() {
        return `<div class="col col-lg-2 col-md-4 col-sm-6 col-12 mb-2" id="div-new-area">
                <div class="card">
                    <div class="card-header text-center">
                        <div class="text-md font-weight-bold text-primary">
                            Nueva area
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <a href="#" class="text-secondary" data-toggle="modal"
                           data-target="#add-area"><i class="fas fa-plus-circle fa-4x"></i>
                        </a>
                    </div>
                </div>
            </div>`;
    }
}