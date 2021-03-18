class Card {
    constructor() {
    }

    getStudentInfoCard1(stdLastname, stdName, stdSchool, stdDni, stdCode) {
        return `<div class="card my-2">
            <div class="card-header">
                        <h3 class="text-dark text-uppercase font-weight-bold">${stdLastname}</h3>
                        <h4 class="text-dark text-capitalize">${stdName}</h4>                    
            </div>
            <div class="card-body">
                <div class="row">
                    
                    <div class="col-lg-12 my-2">
                        <h4 class="text-uppercase small">
                            <span class="text-dark text-uppercase font-weight-bold">Escuela: </span> ${stdSchool}
                        </h4>
                    </div>
                    <div class="col-lg-6">
                        <h6 class="text-dark text-uppercase font-weight-bold small">DNI:</h6>
                        <p class="text-uppercase">${stdDni}</p>
                    </div>
                    <div class="col-lg-6 my-2">
                        <h6 class="text-dark text-uppercase font-weight-bold small">Codigo:</h6>
                        <p class="text-uppercase">${stdCode}</p>
                    </div>
                </div>
            </div>
        </div>`;


    }

    getStudentInfoCard(stdLastname, stdName, stdSchool, stdDni, stdCode, stdProcess) {
        return `
            <div class="card bg-light">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">Datos del alumno</h6>
                </div>
                <div class="card-body">
                    <div class="col col-12 text-primary">
                        <h4>
                            <span class="text-uppercase font-weight-bold">${stdLastname}</span>
                        </h4>
                        <h4>
                            <span class="text-capitalize">${stdName}</span>
                        </h4>
                    </div>
                    <div class="col-lg-12 mt-4">
                        <h3 class="text-uppercase small">
                            <span class="text-uppercase font-weight-bold">Escuela: </span>
                            ${stdSchool}
                        </h3>
                    </div>
                    <div class="col-lg-12">
                        <h3 class="text-uppercase small">
                            <span class="text-uppercase font-weight-bold">Admision: </span>
                            ${stdProcess}
                        </h3>
                    </div>
                    <div class="col-lg-6">
                        <h3 class="text-uppercase small">
                            <span class="text-uppercase font-weight-bold">DNI: </span>
                            ${stdDni}
                        </h3>
                    </div>
                    <div class="col-lg-6 my-2">
                        <h3 class="text-uppercase small">
                            <span class="text-uppercase font-weight-bold">Código: </span>
                            ${stdCode}
                        </h3>
                    </div>
                </div>
            </div>
            `;


    }

    getNotStudentSelectedCard1() {
        return `<div class="card my-2">
            <div class="card-body ">
                <div class="row">
                    <div class="col-lg-12">
                        <h4>No se especifico el alumno</h4>
                        <h4>Use la barra de busqueda</h4>
                    </div>                    
                </div>
            </div>
        </div>`;
    }

    getNotStudentSelectedCard() {
        return `<div class="card bg-warning">
            <div class="card-body ">
                <div class="row">
                    <div class="col-lg-12">
                        <h4>No se especifico el alumno</h4>
                        <h4>Use la barra de busqueda</h4>
                    </div>                    
                </div>
            </div>
        </div>`;
    }

}