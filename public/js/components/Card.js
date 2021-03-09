class Card {
    constructor() {
    }

    getStudentInfoCard(stdLastname, stdName, stdSchool, stdDni, stdCode) {
        return `<div class="card mb-2">
            <div class="card-body ">
                <div class="row">
                    <div class="col-12">
                        <h4 class="text-uppercase">${stdLastname}, ${stdName}</h4>
                    </div>
                    <div class="col-12 mb-1">
                        <h5 class="text-uppercase small">
                            <span class="font-weight-bold">Escuela:</span> ${stdSchool}
                        </h5>
                    </div>
                    <div class="col col-12 col-md-6">
                        <h6 class="text-dark text-uppercase font-weight-bold small">DNI:</h6>
                        <p class="text-uppercase">${stdDni}</p>
                    </div>
                    <div class="col col-12 col-md-6">
                        <h6 class="text-dark text-uppercase font-weight-bold small">Codigo:</h6>
                        <p class="text-uppercase">${stdCode}</p>
                    </div>
                </div>
            </div>
        </div>`;
    }

    getNotStudentSelectedCard() {
        return `<div class="card mb-2">
            <div class="card-body ">
                <div class="row">
                    <div class="col-12">
                        <h2>No se especifico el alumno.</br> Use la barra de busqueda</h2>
                    </div>                    
                </div>
            </div>
        </div>`;
    }

}