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
                    <small class="bg-light border-0 py-2 px-4 w-50 btn-sm font-weight-bold mt-2">${data.process}</small>
                </div>
                <div class="col col-6 d-block text-center list-group-item-action border-left border-top ">
                    <div class="py-3 px-1">
                        <span class="small text-gray-600"><i class="fas fa-venus-mars mr-1"></i>Género</span>
                        <h6 class="mb-0 font-weight-bold">${data.gender}</h6>
                    </div>
                </div>
                <div class="col col-6 d-block text-center list-group-item-action border-left border-top border-right">
                    <div class="py-3 px-1">
                        <span class="small text-gray-600"><i class="bi bi-credit-card-2-front mr-1"></i>DNI</span>
                        <h6 class="mb-0 font-weight-bold">${data.dni}</h6>
                    </div>
                </div>
                <div class="col col-6 d-block text-center list-group-item-action border-left border-top ">
                    <div class="py-3 px-1">
                        <span class="small text-gray-600"><i class="bi bi-person mr-1"></i>Cod. Postulante</span>
                        <h6 class="mb-0 font-weight-bold">${data.postulant_code}</h6>
                    </div>
                </div>
                <div class="col col-6 d-block text-center list-group-item-action border-left border-top border-right">
                    <div class="py-3 px-1">
                        <span class="small text-gray-600"><i class="bi bi-person-fill mr-1"></i>Cod. Universitario</span>
                        <h6 class="mb-0 font-weight-bold">${data.code}</h6>
                    </div>
                </div>
                <div class="col col-6 d-block text-center list-group-item-action border-left border-top  border-bottom" data-toggle="tooltip" data-html="true" title="Orden de mérito general">
                    <div class="py-3 px-1">
                        <span class="small text-gray-600"><i class="bi bi-award mr-1"></i>OMG</span>
                        <h6 class="mb-0 font-weight-bold">${data.omg}</h6>
                    </div>
                </div>
                <div class="col col-6 d-block text-center list-group-item-action border-left border-top border-right border-bottom" data-toggle="tooltip" data-html="true" title="Orden de mérito por programa">
                    <div class="py-3 px-1">
                        <span class="small text-gray-600"><i class="bi bi-star-half mr-1"></i>Puntaje</span>
                        <h6 class="mb-0 font-weight-bold">${data.score}</h6>
                    </div>
                </div>

                <div class="col col-12 mt-4 mb-2">
                    <span>Preguntas Contestadas</span>
                </div>
                <div class="col col-4 rounded-left text-center list-group-item-action border-left border-top border-bottom">
                    <div class="py-2 px-1">
                        <i class="bi bi-check-circle-fill text-success"></i>
                        <h5 class="mb-0 font-weight-bold text-success">${data.correct}</h5>
                        <span class="small text-gray-600">Correctas</span>
                    </div>
                </div>
                <div class="col col-4 d-block text-center list-group-item-action border-left border-top border-bottom">
                    <div class="py-2 px-1">
                        <i class="bi bi-x-circle-fill text-danger"></i>
                        <h5 class="mb-0 font-weight-bold text-danger">${data.incorrect}</h5>
                        <span class="small text-gray-600">Incorrectas</span>
                    </div>
                </div>
                <div class="col col-4 rounded-right d-block text-center list-group-item-action border-left border-top border-right border-bottom">
                    <div class="py-2 px-1">
                        <i class="fas fa-minus-circle text-secondary"></i>
                        <h5 class="mb-0 font-weight-bold text-secondary">${data.blank}</h5>
                        <span class="small text-gray-600">En blanco</span>
                    </div>
                </div>                
            </div>    
            <button id="show-questions" type="button" class="btn btn-info btn-sm btn-block text-gray-900 mt-3" data-toggle="modal"
                    data-target="#exampleModal" onclick="getQuestionsOfStudent(${data.stdtID})">
                <i class="bi bi-list-ol mr-1"></i>Ver respuestas en examen de admisión
            </button>            
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
                    <div class="card-body text-center p-1">
                        <a href="#" class="text-secondary" data-toggle="modal"
                           data-target="#add-area">
                           <h3 class="display-4">
                           <i class="bi bi-plus-circle"></i>
                           </h3> 
                        </a>
                    </div>
                </div>
            </div>`;
    }

    getMyCourseCard(courseName, groupName, areaName, groupID, showData, goToAttendace) {
        let buttons = new Button();
        let col = document.createElement('div');
        col.classList.add('col');
        col.classList.add('col-6');
        col.classList.add('col-lg-3');
        col.classList.add('mb-3');
        let card = document.createElement('div');
        card.classList.add('card');
        card.classList.add('text-center');
        let card_body = document.createElement('div');
        card_body.classList.add('card-body');
        let card_title = document.createElement('h5');
        card_title.classList.add('card-title');
        card_title.classList.add('font-weight-bold');
        card_title.appendChild(document.createTextNode(courseName));
        let card_text = document.createElement('p');
        card_text.classList.add('card-text');
        card_text.appendChild(document.createTextNode(`${groupName} - Area ${areaName}`));
        let card_footer = document.createElement('div');
        card_footer.classList.add('card-footer');
        let btnInfo = buttons.createNormalBtn('light', 'Ver datos', showData, groupID);
        btnInfo.classList.add('mr-2');
        let btnAttendance = buttons.createNormalBtn('primary', 'Asistencia', goToAttendace, groupID);

        card_footer.appendChild(btnInfo);
        card_footer.appendChild(btnAttendance);
        card_body.appendChild(card_title);
        card_body.appendChild(card_text);
        card.appendChild(card_body);
        card.appendChild(card_footer);
        col.appendChild(card);

        return col;
    }
}