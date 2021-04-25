const cbArea = document.getElementById('area');
const cbCourse = document.getElementById('course');
const cbProcess = document.getElementById('process');
const cbDimension = document.getElementById('dimension');
const tbody = document.getElementById('tbody');

//for fpdf
let areaPdf = document.getElementById('areaPdf');
let dimensionPdf = document.getElementById('dimensionPdf');
let coursePdf = document.getElementById('coursePdf');
let processPdf = document.getElementById('processPdf');
let processChart = document.getElementById('processChart');

table = new Table();
button = new Button();
badge = new Badge();
select = new Select();

window.onload = function () {
    fillWhitProcess();
    getAllDimensions();
    document.getElementById('view-title').innerText = 'Vista por Cursos';
};

cbArea.onchange = () => {
    let _areaText = cbArea.options[cbArea.selectedIndex].text;
    areaPdf.value = _areaText;
    getData();
}

cbCourse.onchange = () => {
    getData();
};

cbProcess.onchange = () => {
    getData();
};

cbDimension.onchange = () => {
    coursePdf.value = "";
    let _dimensionText = cbDimension.options[cbDimension.selectedIndex].text;
    dimensionPdf.value = _dimensionText;

    let dimensionID = parseInt(cbDimension.value);
    if (dimensionID > 0) {
        fillWhitCourses(dimensionID);
    } else if (dimensionID === 0) {
        cbCourse.innerHTML = ``;
    }
}

function getData() {
    let _processText = cbProcess.options[cbProcess.selectedIndex].text;
    let _processValue = parseInt(cbProcess.value);
    processPdf.value = _processText;
    processChart.value = _processText;

    let _areaText = cbArea.options[cbArea.selectedIndex].text;
    let _areaValue = parseInt(cbArea.value);

    if (cbCourse.length > 0) {
        let _courseText = cbCourse.options[cbCourse.selectedIndex].text;
        let _courseValue = parseInt(cbCourse.value);
        coursePdf.value = _courseText;
        if (_areaValue > 0 && _courseValue > 0 && _processValue > 0) {
            fillTableWhitCourses(_areaText, _courseText, _processText);
        } else {
            tbody.innerHTML = '';
        }
    }
}

function fillWhitCourses(dimID) {
    let formData = new FormData()
    formData.append('dimID', dimID);

    fetch('app/controllers/courses/getCoursesByDimID.php/', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            data = data.courses;
            cbCourse.innerHTML = ``;
            cbCourse.appendChild(select.createOption(0, 'Selecciona...'));
            data.forEach(course => {
                cbCourse.appendChild(select.createOption(course.id, course.name));
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
            cbProcess.appendChild(select.createOption(0, 'Selecciona...'));
            data.forEach(proc => {
                cbProcess.appendChild(select.createOption(proc.id, proc.name));
            });
        });
}

function fillTableWhitCourses(area, course, process) {
    let formData = new FormData();
    formData.append('area', area);
    formData.append('course', course);
    formData.append('process', process);
    //for fpdf
    areaPdf.value = area;
    coursePdf.value = course;
    processPdf.value = process;
    processChart.value = process;

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
                let row = table.createRow(num, std.code, `${std.lastname} ${std.name}`, std.program);
                let btnShowStudent = button.createButtonForRedirectToStudentView(std.stdID);
                row.appendChild(table.createCell(badge.createBadge(std.stat, std.num)));
                row.appendChild(table.createCell(btnShowStudent));
                tbody.appendChild(row);
                num++;
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