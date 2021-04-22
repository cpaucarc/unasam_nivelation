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

    getStudentInfoCard(lastname, name, program, dni, code, process, omg, omp, correct, incorrect, blank) {
        return `
            <div class="card text-dark">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">Datos del alumno</h6>
                </div>
                <div class="card-body text-center">
                    <div class="row">
                        <div class="col col-12 text-primary mb-0">
                            <h4>
                                <span class="text-uppercase font-weight-bold">${lastname}</span>
                                <span class="text-capitalize">${name}</span>
                            </h4>
                        </div>
    
                        <div class="col col-12">
                            <span>${program}</span>
                        </div>
    
                        <div class="col col-12 mt-3">
                            <h4><span class="badge badge-pill badge-light px-3 py-1 font-weight-normal">${process}</span></h4>
                        </div>
    
                        <div class="col col-12 my-3">
                            <div class="row">
                                <div class="col col-lg-6 mb-2">
                                    <h6 class="mb-0 font-weight-bold">${dni}</h6>
                                    <span class="small text-gray-600">DNI</span>
                                </div>
                                <div class="col col-lg-6">
                                    <h6 class="mb-0 font-weight-bold">${code}</h6>
                                    <span class="small text-gray-600">Código</span>
                                </div>
                            </div>
                        </div>
    
                        <div class="col col-12 my-2">
                            <div class="row">
                                <div class="col col-lg-6">
                                    <h3 class="mb-0"><span class="badge badge-light">${omg}</span></h3>
                                    <span class="small text-gray-600">OMP</span>
                                </div>
                                <div class="col col-lg-6">
                                    <h3 class="mb-0"><span class="badge badge-light">${omp}</span></h3>
                                    <span class="small text-gray-600">OMP</span>
                                </div>
                            </div>
                        </div>
    
                        <div class="col col-12 mt-3">
                            <span>Preguntas Contestadas</span>
                            <div class="row">
                                <div class="col col-4 mt-2">
                                    <h5 class="font-weight-bold text-success mb-0">${correct}</h5>
                                    <span class="small">Correctas</span>
                                </div>
                                <div class="col col-4 mt-2">
                                    <h5 class="font-weight-bold text-danger mb-0">${incorrect}</h5>
                                    <span class="small">Incorrectas</span>
                                </div>
                                <div class="col col-4 mt-2">
                                    <h5 class="font-weight-bold text-secondary mb-0">${blank}</h5>
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