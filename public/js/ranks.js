const cbArea = document.getElementById('area');
const cbProcess = document.getElementById('process');
const tbody = document.getElementById('tbody');
const tbodyDimensions = document.getElementById('tbody-dimension-ranks');
const tb = document.getElementById('table');
const formRank = document.getElementById('form-rank');
const formRankDimension = document.getElementById('form-rank-dimension');

var allRanks;
var currentArea;
var currentProcess;

table = new Table();
button = new Button();
select = new Select();
sweet = new SweetAlerts();

window.onload = function () {
    getAllProcess();
    document.getElementById('view-title').innerText = 'Rangos';
}

cbArea.addEventListener('change', () => {
    let process = cbProcess.value;
    let area = cbArea.options[cbArea.selectedIndex].text;
    currentArea = area;
    console.log(process, area);
    getAllRanksByProcessID(process, area);
    getAllRankDimensionsByProcessID(process, area);
});

cbProcess.addEventListener('change', () => {
    let process = cbProcess.value;
    let area = cbArea.options[cbArea.selectedIndex].text;
    currentProcess = process;
    console.log(process, area);
    getAllRanksByProcessID(process, area);
    getAllRankDimensionsByProcessID(process, area);
});

formRank.onsubmit = (e) => {
    e.preventDefault();
    sweet.waitAlert('Espere un momento porfavor', 'Se está reclasificando a los estudiantes con estos nuevos parametros.');

    let formData = new FormData(formRank);
    fetch('app/controllers/ranks/updateRankValues.php', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === true) {
                sweet.successAlert('¡Éxito!', data.message)
                $('#modal-rank').modal('hide');
                getAllRanksByProcessID(currentProcess, currentArea);
                getAllRankDimensionsByProcessID(currentProcess, currentArea);
            } else {
                sweet.errorAlert('¡Error!', data.message)
            }
        });
}

formRankDimension.onsubmit = (e) => {
    e.preventDefault();
    sweet.waitAlert('Espere un momento porfavor', 'Se está reclasificando a los estudiantes con estos nuevos parametros.');

    let formData = new FormData(formRankDimension);
    fetch('app/controllers/ranks/updateRankDimensionValue.php', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === true) {
                sweet.successAlert('¡Éxito!', data.message)
                $('#modal-rank-dimension').modal('hide');
                getAllRankDimensionsByProcessID(currentProcess, currentArea);
                getAllRanksByProcessID(currentProcess, currentArea);
            } else {
                sweet.errorAlert('¡Error!', data.message)
            }
        });
}

function getAllRankDimensionsByProcessID(process, area) {
    let formData = new FormData();
    formData.append('process', process);
    fetch('app/controllers/ranks/getAllRankDimensionsByProcess.php/', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            data = data.ranks;
            //allRanks = data;
            $('#table-dimension-ranks').DataTable().clear().destroy();
            fillWhitAreas_Dimension(data, area);
            $('#table-dimension-ranks').DataTable();
        });
}

function fillWhitAreas_Dimension(data, areaName) {
    const area = data.filter(rank => rank.area === areaName);
    if (area.length > 0) {
        fillTableForDimensions(area);
    }
}

function fillTableForDimensions(area) {
    tbodyDimensions.innerHTML = '';
    area.forEach((ar, i) => {
        let row = table.createRow((i + 1), ar.area, ar.process, ar.dimension, ar.minimum);
        row.appendChild(table.createCell(button.createBtnEdit(openModalForUpdateRankDimension, ar)));
        tbodyDimensions.appendChild(row);
    });
}

function getAllRanksByProcessID(process, area) {
    let formData = new FormData();
    formData.append('process', process);
    fetch('app/controllers/ranks/getAllRanksByProcess.php/', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            data = data.ranks;
            allRanks = data;
            $('#table-ranks').DataTable().clear().destroy();
            fillWhitAreas(data, area);
            $('#table-ranks').DataTable();
        });
}

function fillWhitAreas(data, areaName) {
    const area = data.filter(rank => rank.area === areaName);
    if (area.length > 0) {
        fillTableForCourses(area);
    }
}

function fillTableForCourses(area) {
    tbody.innerHTML = '';
    area.forEach((ar, i) => {
        let row = table.createRow((i + 1), ar.area, ar.process, ar.course, ar.minimum, ar.recommended);
        row.appendChild(table.createCell(button.createBtnEdit(openModalForUpdateRankCourse, ar)));
        tbody.appendChild(row);
    });
}

function openModalForUpdateRankCourse(area) {
    document.getElementById('txCourse').value = area.course;
    document.getElementById('txMin').value = area.minimum;
    document.getElementById('txMax').value = area.recommended;
    document.getElementById('rankID').value = area.id;
    $('#modal-rank').modal('show');
}

function openModalForUpdateRankDimension(area) {
    document.getElementById('dimension').value = area.dimension;
    document.getElementById('min').value = area.minimum;
    document.getElementById('rankDimensionID').value = area.id;
    $('#modal-rank-dimension').modal('show');
}

function getAllProcess() {
    fetch('app/controllers/process/getAllProcess.php/', {
        method: 'GET',
        headers: {
            "Accept": "application/json"
        }
    })
        .then(response => response.json())
        .then(data => {
            data = data.process;
            cbProcess.innerHTML = ``;
            cbProcess.appendChild(select.createOption(0, 'Selecciona...'));
            data.forEach(proc => {
                cbProcess.appendChild(select.createOption(proc.id, proc.name));
            });
        });
}