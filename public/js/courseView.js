const cbArea = document.getElementById('area');
const cbCourse = document.getElementById('course');
const cbProcess = document.getElementById('process');
const tbody = document.getElementById('tbody');

//for fpdf
let btShowPDF = document.getElementById('btShowPDF');

let csAREAPDF = document.getElementById('csAREAPDF');
let csCOURSEPDF = document.getElementById('csCOURSEPDF');
let csPROCESSPDF = document.getElementById('csPROCESSPDF');

table = new Table();
button = new Button();
badge = new Badge();

window.onload = function () {
    fillWhitCourses();
    fillWhitProcess();
    document.getElementById('view-title').innerText = 'Vista por Cursos';
    //for fpdf
    csAREAPDF.value = "";
    csCOURSEPDF.value = "";
    csPROCESSPDF.value = "";
};

cbArea.addEventListener('change', () => {
    let _areaText = cbArea.options[cbArea.selectedIndex].text;
    let _courseText = cbCourse.options[cbCourse.selectedIndex].text;
    let _processText = cbProcess.options[cbProcess.selectedIndex].text;
    let _areaValue = parseInt(cbArea.value);
    let _courseValue = parseInt(cbCourse.value);
    let _processValue = parseInt(cbProcess.value);
    if (_areaValue > 0 && _courseValue > 0 && _processValue > 0) {
        fillTableWhitCourses(_areaText, _courseText, _processText);
    }
});

cbCourse.addEventListener('change', () => {
    let _areaText = cbArea.options[cbArea.selectedIndex].text;
    let _courseText = cbCourse.options[cbCourse.selectedIndex].text;
    let _processText = cbProcess.options[cbProcess.selectedIndex].text;
    let _areaValue = parseInt(cbArea.value);
    let _courseValue = parseInt(cbCourse.value);
    let _processValue = parseInt(cbProcess.value);
    if (_areaValue > 0 && _courseValue > 0 && _processValue > 0) {
        fillTableWhitCourses(_areaText, _courseText, _processText);
    }
});

cbProcess.addEventListener('change', () => {
    let _areaText = cbArea.options[cbArea.selectedIndex].text;
    let _courseText = cbCourse.options[cbCourse.selectedIndex].text;
    let _processText = cbProcess.options[cbProcess.selectedIndex].text;
    let _areaValue = parseInt(cbArea.value);
    let _courseValue = parseInt(cbCourse.value);
    let _processValue = parseInt(cbProcess.value);
    if (_areaValue > 0 && _courseValue > 0 && _processValue > 0) {
        fillTableWhitCourses(_areaText, _courseText, _processText);
    }
});

function fillWhitCourses() {
    fetch('app/controllers/courses/getAllCourses.php/', {
        method: 'GET',
        headers: {
            "Accept": "application/json"
        }
    })
        .then(response => response.json())
        .then(data => {
            data = data.courses;
            cbCourse.innerHTML = ``;
            cbCourse.appendChild(createOptionForSelect('0', 'Selecciona...'));
            data.forEach(course => {
                cbCourse.appendChild(createOptionForSelect(course.id, course.name));
            });
        });
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
            cbProcess.appendChild(createOptionForSelect('0', 'Selecciona...'));
            data.forEach(proc => {
                cbProcess.appendChild(createOptionForSelect(proc.id, proc.denomination));
            });
        });
}

function fillTableWhitCourses(area, course, process) {
    let formData = new FormData();
    formData.append('area', area);
    formData.append('course', course);
    formData.append('process', process);
    //for fpdf
    csAREAPDF.value = area;
    csCOURSEPDF.value = course;
    csPROCESSPDF.value = process;

    fetch('app/controllers/student/getStudentsbyCourse.php/', {
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
                let row = table.createRow(num, std.dni, std.code,
                    (std.lastname + ' ' + std.name), std.school);
                let btnShowStudent = button.createButtonForRedirectToStudentView(std.stdID);
                row.appendChild(table.createCell(badge.createBadge(std.stat, std.num)));
                row.appendChild(table.createCell(btnShowStudent));
                tbody.appendChild(row);
                num++;
            })
            $('#table-students').DataTable();
        });
}

function createOptionForSelect(value, text) {
    let opt = document.createElement('option');
    opt.setAttribute("value", value);
    opt.innerText = text;
    return opt;
}