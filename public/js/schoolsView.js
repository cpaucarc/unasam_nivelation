const cbArea = document.getElementById('area');
const cbProcess = document.getElementById('process');
const cbSchool = document.getElementById('school');
const tbody = document.getElementById('tbody');

//for fpdf
let areaPdf_1 = document.getElementById('areaPdf_1');
let areaPdf_2 = document.getElementById('areaPdf_2');
let programPdf_1 = document.getElementById('programPdf_1');
let processPdf_1 = document.getElementById('processPdf_1');
let processPdf_2 = document.getElementById('processPdf_2');
let processPdf_3 = document.getElementById('processPdf_3');
let processChart = document.getElementById('processChart');

table = new Table();
button = new Button();
select = new Select();

window.onload = () => {
    fillWhitProcess();
    document.getElementById('view-title').innerText = 'Vista por Programas Académicos';
}

cbSchool.addEventListener('change', () => {
    let _schoolText = cbSchool.options[cbSchool.selectedIndex].text;
    let _schoolValue = parseInt(cbSchool.value);
    let _processText = cbProcess.options[cbProcess.selectedIndex].text;
    let _processValue = parseInt(cbProcess.value);
    if (_schoolValue > 0 && _processValue > 0) {
        fillTableWhitStudents(_schoolText, _processText);
    }
});

cbProcess.addEventListener('change', () => {
    let _processText = cbProcess.options[cbProcess.selectedIndex].text;
    let _processValue = parseInt(cbProcess.value);
    //processPdf.value = _processText;
    processChart.value = _processText;

    let _schoolText = cbSchool.options[cbSchool.selectedIndex].text;
    let _schoolValue = parseInt(cbSchool.value);

    if (_schoolValue > 0 && _processValue > 0) {
        fillTableWhitStudents(_schoolText, _processText);
    }
});

cbArea.addEventListener('change', () => {
    let _areaText = cbArea.options[cbArea.selectedIndex].text;
    let _areaValue = parseInt(cbArea.value);
    if (_areaValue > 0) {
        fillWhitSchools(_areaText);
        clearTable();
    }
});

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

function fillWhitSchools(area) {
    let formData = new FormData();
    formData.append('area', area);
    //for fpdf
    areaPdf_1.value = area;
    areaPdf_2.value = area;

    fetch('app/controllers/school/getSchoolsByArea.php/', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            data = data.programs;
            cbSchool.innerHTML = ``;
            cbSchool.appendChild(select.createOption(0, 'Selecciona...'));
            data.forEach(proc => {
                cbSchool.appendChild(select.createOption(proc.id, proc.name));
            });
        });
}

function clearTable() {
    tbody.innerHTML = '';
}

function fillTableWhitStudents(school, process) {
    let formData = new FormData();
    formData.append('school', school);
    formData.append('process', process);
    //for fpdf
    programPdf_1.value = school;
    processPdf_1.value = process;
    processPdf_2.value = process;
    processPdf_3.value = process;
    processChart.value = process;

    fetch('app/controllers/student/getStudentsBySchool.php/', {
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
            let num = 1;
            data.forEach(std => {
                let row = table.createRow(num, std.omg, std.score, std.dni, std.code, std.gender, `${std.lastname} ${std.name}`);
                let btnShowStudent = button.createButtonForRedirectToStudentView(std.id);
                row.appendChild(table.createCell(btnShowStudent));
                tbody.appendChild(row);
                num++;
            })
            $('#table-students').DataTable();
        });
}

function getAllAreas() {
    fetch('app/controllers/area/getAllAreas.php/', {
        method: 'GET',
        headers: {
            "Accept": "application/json"
        }
    })
        .then(response => response.json())
        .then(data => {
            data = data.areas;
            cbArea.innerHTML = ``;
            cbArea.appendChild(select.createOption(0, 'Selecciona...'));
            data.forEach(area => {
                cbArea.appendChild(select.createOption(area.id, area.name));
            });
        });
}