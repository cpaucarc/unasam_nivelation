const cbArea = document.getElementById('area');
const cbProcess = document.getElementById('process');
const selectedArea = document.getElementById('selectedArea');
const selectedProcess = document.getElementById('selectedProcess');
const tbody = document.getElementById('tbody');
const tb = document.getElementById('table');
const formRank = document.getElementById('form-rank');

var allRanks;
var currentArea;
var currentProcess;

table = new Table();
button = new Button();

window.onload = function () {
    getAllProcess();
}

cbArea.addEventListener('change', () => {
    let process = cbProcess.value;
    let area = cbArea.options[cbArea.selectedIndex].text;
    selectedArea.innerText = area;
    currentArea = area;
    getAllRanksByProcessID(process, area);
});

cbProcess.addEventListener('change', () => {
    let process = cbProcess.value;
    let area = cbArea.options[cbArea.selectedIndex].text;
    selectedProcess.innerText = cbProcess.options[cbProcess.selectedIndex].text;
    currentProcess = process;
    getAllRanksByProcessID(process, area);
});

formRank.addEventListener('submit', (e) => {
    e.preventDefault();
    let formData = new FormData(formRank);

    fetch('http://localhost/nivelation/app/controllers/ranks/updateRankValues.php', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data.status === true) {
                $('#modal-rank').modal('hide');
                getAllRanksByProcessID(currentProcess, currentArea);
            }
            // alert(data.message);
        });
});

function getAllRanksByProcessID(process, area) {
    let formData = new FormData();
    formData.append('process', process);
    fetch('http://localhost/nivelation/app/controllers/ranks/getAllRanksByProcess.php/', {
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
            switch (area) {
                case 'A': {
                    fillWhitAreaA(data);
                    break;
                }
                case 'B': {
                    fillWhitAreaB(data);
                    break;
                }
                case 'C': {
                    fillWhitAreaC(data);
                    break;
                }
                case 'D': {
                    fillWhitAreaD(data);
                    break;
                }
                default : {
                    fillWhitAreaA(data);
                    break;
                }
            }
            $('#table-ranks').DataTable();
        });
}

function fillWhitAreaA(data) {
    const area = data.filter(rank => rank.area === 'A');
    if (area.length > 0) {
        console.log(area);
        createRowsAndFillTable(area);
    }
}

function fillWhitAreaB(data) {
    const area = data.filter(rank => rank.area === 'B');
    if (area.length > 0) {
        console.log(area);
        createRowsAndFillTable(area);
    }
}

function fillWhitAreaC(data) {
    const area = data.filter(rank => rank.area === 'C');
    if (area.length > 0) {
        console.log(area);
        createRowsAndFillTable(area);
    }
}

function fillWhitAreaD(data) {
    const area = data.filter(rank => rank.area === 'D');
    if (area.length > 0) {
        console.log(area);
        createRowsAndFillTable(area);
    }
}

function createRowsAndFillTable(area) {
    tbody.innerHTML = '';
    let i = 1;
    area.forEach(courses => {
        let row = table.createRow(i, courses.course, courses.area,
            courses.process, courses.minimal, courses.maximun);

        // let btnTD = document.createElement('td');
        // btnTD.appendChild(button.createBtnPrimary('e', updateRank, courses.id));
        // btnTD.appendChild(button.createBtnPrimary('d', deleteRank, courses.id));
        row.appendChild(table.createCell(button.createBtnEdit(updateRank, courses.id)));

        tbody.appendChild(row);
        i++;
    });
}

function updateRank(id) {
    let rankGetIt = getRankDataByID(parseInt(id));
    if (rankGetIt) {
        document.getElementById('txCourse').value = rankGetIt.course;
        document.getElementById('txMin').value = rankGetIt.minimal;
        document.getElementById('txMax').value = rankGetIt.maximun;
        document.getElementById('rankID').value = rankGetIt.id;
        document.getElementById('btnSubmitForm').innerText = 'Editar Valores';
        $('#modal-rank').modal('show');
    }
}

function deleteRank(id) {
    alert('Eliminar ' + id);
    formRank.reset();
}

function getAllProcess() {
    fetch('http://localhost/nivelation/app/controllers/process/getAllProcess.php/', {
        method: 'GET',
        headers: {
            "Accept": "application/json"
        }
    })
        .then(response => response.json())
        .then(data => {
            data = data.process;
            cbProcess.innerHTML = ``;

            cbProcess.appendChild(createOptionForSelect('0', 'Selecciona...'));
            data.forEach(proc => {
                cbProcess.appendChild(createOptionForSelect(proc.id, proc.denomination));
            });
        });
}

function createOptionForSelect(value, text) {
    let opt = document.createElement('option');
    opt.setAttribute("value", value);
    opt.innerText = text;
    return opt;
}

function getRankDataByID(id) {
    let rank = allRanks.filter(rank => parseInt(rank.id) === id);
    return rank[0];
}