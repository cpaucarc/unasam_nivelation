const cbArea = document.getElementById('area');
const cbProcess = document.getElementById('process');
const selectedArea = document.getElementById('selectedArea');
const selectedProcess = document.getElementById('selectedProcess');
const tbody = document.getElementById('tbody');
const tb = document.getElementById('table');

table = new Table();
button = new Button();

window.onload = function () {
    console.log('hello')
}

cbArea.addEventListener('change', () => {
    let process = cbProcess.value;
    let area = cbArea.options[cbArea.selectedIndex].text;
    selectedArea.innerText = area;
    getAllRanksByProcessID(process, area);
});

cbProcess.addEventListener('change', () => {
    let process = cbProcess.value;
    let area = cbArea.options[cbArea.selectedIndex].text;
    selectedProcess.innerText = cbProcess.options[cbProcess.selectedIndex].text;
    console.log(process);
    getAllRanksByProcessID(process, area);
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

        let btnTD = document.createElement('td');
        btnTD.appendChild(button.createBtnPrimary('e', updateRank, courses.id));
        btnTD.appendChild(button.createBtnPrimary('d', deleteRank, courses.id));
        row.appendChild(btnTD);

        tbody.appendChild(row);
        i++;
    });
}

function updateRank(id) {
    alert('Editar ' + id);
}

function deleteRank(id) {
    alert('Eliminar ' + id);
}