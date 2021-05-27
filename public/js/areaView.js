const cbArea = document.getElementById('area');
const cbProcess = document.getElementById('process');
const tbody = document.getElementById('tbody');



//for fpdf
let areaPdf_1 = document.getElementById('areaPdf_1');
let areaPdf_2 = document.getElementById('areaPdf_2');
let processPdf_1 = document.getElementById('processPdf_1');
let processPdf_2 = document.getElementById('processPdf_2');
let processChart = document.getElementById('processChart');

table = new Table();
button = new Button();
badge = new Badge();
select = new Select();

window.onload = function () {
    fillWhitProcess();
    document.getElementById('view-title').innerText = 'Vista por Areas';
};

cbArea.onchange = () => {
    getData();
}

cbProcess.onchange = () => {
    getData();
};

function getData() {
    let areaID = parseInt(cbArea.value);
    let processID = parseInt(cbProcess.value);
    console.log(areaID)
    console.log(processID);

    if (areaID > 0 && processID > 0) {
        fillTableWhitCourses(areaID, processID);
        var _processText = cbProcess.options[cbProcess.selectedIndex].text;
        var _areaText = cbArea.options[cbArea.selectedIndex].text;
        areaPdf_1.value = _areaText;
        areaPdf_2.value = _areaText;
        processPdf_1.value = _processText;
        processPdf_2.value = _processText;
        processChart.value = _processText;
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

function fillTableWhitCourses(area, process) {
    let formData = new FormData();
    formData.append('area', area);
    formData.append('process', process);

    fetch('app/controllers/student/getStudentsByArea.php/', {
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
                //id, code, name, lastname, score, program, area, process, -stat-, recomendation
                let row = table.createRow((i + 1), std.code, `${std.lastname} ${std.name}`,
                    std.score, std.program, std.area, std.process);
                let btnShowStudent = button.createButtonForRedirectToStudentView(std.id);
                row.appendChild(table.createCell(badge.createBadge(std.recomendation, std.stat)));
                row.appendChild(table.createCell(btnShowStudent));
                tbody.appendChild(row);
            })
            $('#table-students').DataTable();
        });
}

function getAllDimensions() {
    fetch('app/controllers/dimension/getAllDimensions.php/', {
        method: 'GET',
        headers: {
            "Accept": "application/json"
        }
    })
        .then(response => response.json())
        .then(data => {
            data = data.dimensions;
            cbDimension.innerHTML = ``;
            cbDimension.appendChild(select.createOption(0, 'Selecciona...'));
            data.forEach(dim => {
                cbDimension.appendChild(select.createOption(dim.id, dim.name));
            });
        });
}