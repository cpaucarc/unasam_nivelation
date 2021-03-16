class Card {
    constructor() {
    }

    getStudentInfoCard(stdLastname, stdName, stdSchool, stdDni, stdCode) {
        return `<div class="card my-2">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="text-dark text-uppercase font-weight-bold">${stdLastname}, ${stdName}</h4>
                    </div>
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

    getNotStudentSelectedCard() {
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

}