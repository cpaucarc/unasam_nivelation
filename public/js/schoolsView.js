const cbArea = document.getElementById('area');
const cbProcess = document.getElementById('process');
const cbSchool = document.getElementById('school');
const tbody = document.getElementById('tbody');

//for fpdf

let btShowPDF = document.getElementById('btShowPDF');

let scAREAPDF = document.getElementById('scAREAPDF');
let scSCHOOLPDF = document.getElementById('scSCHOOLPDF');
let scPROCESSPDF = document.getElementById('scPROCESSPDF');

table = new Table();
button = new Button();

window.onload = () => {
    fillWhitProcess();
    //for dpdf
    scAREAPDF.value = "";
    scPROCESSPDF.value = "";
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
    let _schoolText = cbSchool.options[cbSchool.selectedIndex].text;
    let _schoolValue = parseInt(cbSchool.value);
    let _processText = cbProcess.options[cbProcess.selectedIndex].text;
    let _processValue = parseInt(cbProcess.value);
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
            cbProcess.appendChild(createOptionForSelect('0', 'Selecciona...'));
            data.forEach(proc => {
                cbProcess.appendChild(createOptionForSelect(proc.id, proc.denomination));
            });
        });
}

function fillWhitSchools(area) {
    let formData = new FormData();
    formData.append('area', area);
    //for fpdf
    scAREAPDF.value = area;
    fetch('app/controllers/school/getSchoolsByArea.php/', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            data = data.schools;
            cbSchool.innerHTML = ``;
            cbSchool.appendChild(createOptionForSelect('0', 'Selecciona...'));
            data.forEach(proc => {
                cbSchool.appendChild(createOptionForSelect(proc.id, proc.name));
            });
        });
}

function clearTable() {
    tbody.innerHTML = '';
}

function createOptionForSelect(value, text) {
    let opt = document.createElement('option');
    opt.setAttribute("value", value);
    opt.innerText = text;
    return opt;
}

function fillTableWhitStudents(school, process) {
    let formData = new FormData();
    formData.append('school', school);
    formData.append('process', process);
    console.log(school, process);

    //for fpdf
    scSCHOOLPDF.value = school;
    scPROCESSPDF.value = process;

    fetch('app/controllers/student/getStudentsBySchool.php/', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            data = data.students;
            console.log(data);
            tbody.innerHTML = '';
            $('#table-students').DataTable().clear().destroy();
            let num = 1;
            data.forEach(std => {
                let row = table.createRow(num, std.dni, std.code,
                    (std.lastname + ' ' + std.name));
                // let btnShowStudent = createRedirectButton(std.id);
                let btnShowStudent = button.createButtonForRedirectToStudentView(std.id);
                row.appendChild(table.createCell(btnShowStudent));
                tbody.appendChild(row);
                num++;
            })
            $('#table-students').DataTable();
        });
}