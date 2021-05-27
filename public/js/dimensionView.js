const cbArea = document.getElementById('area');
const cbProcess = document.getElementById('process');
const cbDimension = document.getElementById('dimension');
const tbody = document.getElementById('tbody');

//for fpdf
let areaPDF1 = document.getElementById('areaPDF1');
let dimPDF1 = document.getElementById('dimensionPDF1');
let processPDF1 = document.getElementById('processPDF1');

let areaPDF2 = document.getElementById('areaPDF2');
let processPDF2 = document.getElementById('processPDF2');
let processPDF3 = document.getElementById('processPDF3');

let processChart = document.getElementById('processChart');

table = new Table();
button = new Button();
badge = new Badge();
select = new Select();

window.onload = function () {
    fillWhitProcess();
    document.getElementById('view-title').innerText = 'Vista por Dimensiones';
};

cbArea.onchange = () => {
    getData();
}

cbProcess.onchange = () => {
    getData();
};

cbDimension.onchange = () => {
    getData();
}

function getData() {
    let procID = parseInt(cbProcess.value);
    let areaID = parseInt(cbArea.value);
    let dimID = parseInt(cbDimension.value);

    processPDF1.value = procID;
    processPDF2.value = procID;
    processPDF3.value = procID;
    areaPDF1.value = areaID;
    areaPDF2.value = areaID;
    dimPDF1.value = dimID;

    if (areaID > 0 && procID > 0) {
        fillTableWhitStudents(areaID, procID);
    } else {
        tbody.innerHTML = '';
    }
}

function fillWhitProcess() {
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

function fillTableWhitStudents(area, process) {
    let formData = new FormData();
    formData.append('area', area);
    formData.append('process', process);
    
    fetch('app/controllers/student/getStudentsByDimension.php/', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            data = data.students;
            tbody.innerHTML = '';
            $('#table-students').DataTable().clear().destroy();
            data.forEach((std, i) => {
                let row = table.createRow((i + 1), std.code, std.score, std.student, std.program);
                let btnShowStudent = button.createButtonForRedirectToStudentView(std.id);
                row.appendChild(table.createCell(badge.createBadge(std.stat, std.num)));
                row.appendChild(table.createCell(btnShowStudent));
                tbody.appendChild(row);
            })
            $('#table-students').DataTable();
        });
}