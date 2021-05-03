class Card {
    constructor() {
    }

    getStudentInfoCard2(stdLastname, stdName, stdSchool, stdDni, stdCode, stdProcess) {
        return `
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">Datos del alumno</h6>
                </div>
                <div class="card-body">
                    <div class="col col-12 text-primary form-inline">
                        <h4 class="text-uppercase font-weight-bold">${stdLastname}</h4>&nbsp;
                        <h4 class="text-capitalize">${stdName}</h4>
                    </div>
                    <hr>
                    <div class="col col-12 mt-2 form-inline">
                        <span class="font-weight-bold">DNI:</span>&nbsp;
                        <span>${stdDni}</span>
                    </div>
                    <div class="col col-12 mt-2 form-inline">
                        <span class="font-weight-bold">Código:</span>&nbsp;
                        <span>${stdCode}</span>
                    </div> 
                    <hr>
                    <div class="col col-12 mt-4 form-inline">
                        <span class="font-weight-bold">Escuela:</span>&nbsp;
                        <span>${stdSchool}</span>
                    </div>
                    <hr>
                    <div class="col col-12 mt-2 form-inline">
                        <span class="font-weight-bold">Admision de Ingreso:</span>&nbsp;
                        <span>${stdProcess}</span>
                    </div>   
                    <div class="col col-12 mt-2 form-inline">
                        <span class="font-weight-bold">OMG:</span>&nbsp;
                        <span>15</span>
                    </div>   
                    <div class="col col-12 mt-2 form-inline">
                        <span class="font-weight-bold">OMP:</span>&nbsp;
                        <span>7</span>
                    </div>     
                    <hr>                    
                    <div class="col col-12 mt-2 form-inline">
                        <span class="font-weight-bold">Preguntas Correctas:</span>&nbsp;
                        <span>50</span>
                    </div>                   
                    <div class="col col-12 mt-2 form-inline">
                        <span class="font-weight-bold">Preguntas Incorrectas:</span>&nbsp;
                        <span>40</span>
                    </div>                   
                    <div class="col col-12 mt-2 form-inline">
                        <span class="font-weight-bold">Preguntas en Blanco:</span>&nbsp;
                        <span>10</span>
                    </div>                 
                </div>
            </div>
            `;
    }

    getStudentInfoCard(data) {
        return `
            <div class="card text-dark">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">Datos del alumno</h6>
                </div>
                <div class="card-body text-center">
                    <div class="row">
                        <div class="col col-12 text-primary mb-0">
                            <h4>
                                <span class="text-uppercase font-weight-bold">${data.lastname}</span>
                                <span class="text-capitalize">${data.name}</span>
                            </h4>
                        </div>
    
                        <div class="col col-12">
                            <span>${data.program}</span>
                        </div>
    
                        <div class="col col-12 mt-3">
                            <h4><span class="badge badge-pill badge-light px-3 py-1 font-weight-normal">${data.process}</span></h4>
                        </div>
    
                        <div class="col col-12 my-3">
                            <div class="row">
                                <div class="col col-lg-6 mb-2">
                                    <h6 class="mb-0 font-weight-bold">${data.dni}</h6>
                                    <span class="small text-gray-600">DNI</span>
                                </div>
                                <div class="col col-lg-6">
                                    <h6 class="mb-0 font-weight-bold">${data.code}</h6>
                                    <span class="small text-gray-600">Código</span>
                                </div>
                            </div>
                        </div>
    
                        <div class="col col-12 my-2">
                            <div class="row">
                                <div class="col col-lg-6">
                                    <h3 class="mb-0"><span class="badge badge-light">${data.omg}</span></h3>
                                    <span class="small text-gray-600">OMP</span>
                                </div>
                                <div class="col col-lg-6">
                                    <h3 class="mb-0"><span class="badge badge-light">${data.omp}</span></h3>
                                    <span class="small text-gray-600">OMP</span>
                                </div>
                            </div>
                        </div>
    
                        <div class="col col-12 mt-3">
                            <span>Preguntas Contestadas</span>
                            <div class="row">
                                <div class="col col-4 mt-2">
                                    <h5 class="font-weight-bold text-success mb-0">${data.correct}</h5>
                                    <span class="small">Correctas</span>
                                </div>
                                <div class="col col-4 mt-2">
                                    <h5 class="font-weight-bold text-danger mb-0">${data.incorrect}</h5>
                                    <span class="small">Incorrectas</span>
                                </div>
                                <div class="col col-4 mt-2">
                                    <h5 class="font-weight-bold text-secondary mb-0">${data.blank}</h5>
                                    <span class="small">En Blanco</span>
                                </div>
                            </div>
                        </div>
    
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