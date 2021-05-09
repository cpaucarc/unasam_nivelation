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
select = new Select();

window.onload = function () {
    getAllProcess();
    document.getElementById('view-title').innerText = 'Rangos';
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
                AlertConfirm(data.message, 'success', '¡Éxito!', 'primary');
                $('#modal-rank').modal('hide');
                getAllRanksByProcessID(currentProcess, currentArea);
            } else {
                AlertConfirm(data.message, 'error', '¡Error!', 'danger');
            }
            // alert(data.message);
        });
});

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
        createRowsAndFillTable(area);
    }
}

function fillWhitAreaB(data) {
    const area = data.filter(rank => rank.area === 'B');
    if (area.length > 0) {
        createRowsAndFillTable(area);
    }
}

function fillWhitAreaC(data) {
    const area = data.filter(rank => rank.area === 'C');
    if (area.length > 0) {
        createRowsAndFillTable(area);
    }
}

function fillWhitAreaD(data) {
    const area = data.filter(rank => rank.area === 'D');
    if (area.length > 0) {
        createRowsAndFillTable(area);
    }
}

function createRowsAndFillTable(area) {
    tbody.innerHTML = '';
    let i = 1;
    area.forEach(courses => {
        let row = table.createRow(i, courses.process, courses.course, courses.minimum, courses.recommended);

        row.appendChild(table.createCell(button.createBtnEdit(updateRank, courses.id)));

        tbody.appendChild(row);
        i++;
    });
}

function updateRank(id) {
    let rankGetIt = getRankDataByID(parseInt(id));
    if (rankGetIt) {
        document.getElementById('txCourse').value = rankGetIt.course;
        document.getElementById('txMin').value = rankGetIt.minimum;
        document.getElementById('txMax').value = rankGetIt.recommended;
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

function getRankDataByID(id) {
    let rank = allRanks.filter(rank => parseInt(rank.id) === id);
    return rank[0];
}


//SweetAlert2
function AlertConfirm(message, tipe, title, variable) {
    if (message != '') {
        Swal.fire({
            icon: tipe,
            title: title,
            text: message,
            iconColor: 'var(--' + variable + ')',
            showCloseButton: true,
            confirmButtonColor: 'var(--' + variable + ')'
        })
    }
}