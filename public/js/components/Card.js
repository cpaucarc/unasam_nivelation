class Card {
    constructor() {
    }

    getStudentInfoCard(data) {
        return `
    <div class="card text-dark">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold">Datos del estudiante</h6>
        </div>
        <div class="card-body text-center">
            <div class="row">
                <div class="col col-12 text-primary mb-0">
                    <h5>
                        <span class="text-uppercase font-weight-bold">${data.lastname}</span>
                        <span class="text-capitalize">${data.name}</span>
                    </h5>
                </div>
                <div class="col col-12">
                    <span>${data.program}</span>
                </div>
                <div class="col col-12 mt-2 mb-4">
                    <span class="bg-light py-2 px-4 w-50 btn-sm font-weight-bold font-size-sm mt-2">${data.process}</span>
                </div>
                <div class="col col-6 d-block text-center list-group-item-action border-left border-top ">
                    <div class="py-2 px-2">
                        <i class="fas fa-venus-mars text-secondary"></i>
                        <h6 class="mb-0 font-weight-bold">${data.gender}</h6>
                        <span class="small text-gray-600">Género</span>
                    </div>
                </div>
                <div class="col col-6 d-block text-center list-group-item-action border-left border-top border-right">
                    <div class="py-2 px-2">
                        <i class="bi bi-credit-card-2-front text-secondary"></i>
                        <h6 class="mb-0 font-weight-bold">${data.dni}</h6>
                        <span class="small text-gray-600">DNI</span>
                    </div>
                </div>
                <div class="col col-6 d-block text-center list-group-item-action border-left border-top ">
                    <div class="py-2 px-2">
                        <i class="bi bi-person text-secondary"></i>
                        <h6 class="mb-0 font-weight-bold">${data.postulant_code}</h6>
                        <span class="small text-gray-600">Cod. Postulante</span>
                    </div>
                </div>
                <div class="col col-6 d-block text-center list-group-item-action border-left border-top border-right">
                    <div class="py-2 px-2">
                        <i class="bi bi-person-fill text-secondary"></i>
                        <h6 class="mb-0 font-weight-bold">${data.code}</h6>
                        <span class="small text-gray-600">Cod. Universitario</span>
                    </div>
                </div>
                <div class="col col-6 d-block text-center list-group-item-action border-left border-top  border-bottom" data-toggle="tooltip" data-html="true" title="Orden de mérito general">
                    <div class="py-2 px-2">
                        <i class="bi bi-award text-secondary"></i>
                        <h6 class="mb-0 font-weight-bold">${data.omg}</h6>
                        <span class="small text-gray-600">OMG</span>
                    </div>
                </div>
                <div class="col col-6 d-block text-center list-group-item-action border-left border-top border-right border-bottom" data-toggle="tooltip" data-html="true" title="Orden de mérito por programa">
                    <div class="py-2 px-2">
                        <i class="bi bi-star-half text-secondary"></i>
                        <h6 class="mb-0 font-weight-bold">${data.score}</h6>
                        <span class="small text-gray-600">Puntaje</span>
                    </div>
                </div>

                <div class="col col-12 mt-4 mb-2">
                    <span>Preguntas Contestadas</span>
                </div>
                <div class="col col-4 text-center list-group-item-action border-left border-top border-bottom">
                    <div class="py-2 px-2">
                        <i class="bi bi-check-circle-fill text-success"></i>
                        <h6 class="mb-0 font-weight-bold text-success">${data.correct}</h6>
                        <span class="small text-gray-600">Correctas</span>
                    </div>
                </div>
                <div class="col col-4 d-block text-center list-group-item-action border-left border-top border-bottom">
                    <div class="py-2 px-2">
                        <i class="bi bi-x-circle-fill text-danger"></i>
                        <h6 class="mb-0 font-weight-bold text-danger">${data.incorrect}</h6>
                        <span class="small text-gray-600">Incorrectas</span>
                    </div>
                </div>
                <div class="col col-4 d-block text-center list-group-item-action border-left border-top border-right border-bottom">
                    <div class="py-2 px-2">
                        <i class="bi bi-dash-circle-fill text-secondary"></i>
                        <h6 class="mb-0 font-weight-bold text-secondary">${data.blank}</h6>
                        <span class="small text-gray-600">En blanco</span>
                    </div>
                </div>                
            </div>    
            <div class="d-flex justify-content-end mt-3">
                <button id="show-questions" type="button" class="btn btn-info text-gray-900 btn-sm" data-toggle="modal"
                        data-target="#exampleModal" onclick="getQuestionsOfStudent(${data.stdtID})">
                    <i class="bi bi-list-ol mr-1"></i>Ver respuestas en examen de admisión
                </button>
            </div>            
        </div>
    </div>
            `;
    }

    getNotStudentSelectedCard() {
        return `<div class="alert alert-danger" role="alert">
            <div class="row">
                <div class="col col-2">
                    <h2>
                    <i class="bi bi-info-circle-fill"></i>
                    </h2>
                </div>
                <div class="col col-10 pl-3">
                    <h6 class="font-weight-bold">Atención:</h6>
                    <small>No se especificó el nombre del alumno. Use la barra de busqueda.</small>
                </div>
            </div>
        </div>`;
    }

    getAddNewAreaCard() {
        return `<div class="col col-lg-2 col-md-4 col-sm-6 col-12 mb-2" id="div-new-area">
                <div class="card">
                    <div class="card-header text-center p-2">
                        <div class="text-md font-weight-bold">
                            Nueva area
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <a href="#" class="text-secondary" data-toggle="modal"
                           data-target="#add-area">
                           <h2 class="display-4">
                           <i class="bi bi-plus-circle"></i>
                           </h2> 
                        </a>
                    </div>
                </div>
            </div>`;
    }
}