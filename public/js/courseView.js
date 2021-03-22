const cbArea = document.getElementById('area');
const cbCourse = document.getElementById('course');
const cbProcess = document.getElementById('process');
const tbody = document.getElementById('tbody');

table = new Table();
button = new Button();

window.onload = function () {
    console.log('cargo con exito');
    fillWhitCourses();
    fillWhitProcess();
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
    fetch('http://localhost/nivelation/app/controllers/courses/getAllCourses.php/', {
        method: 'GET',
        headers: {
            "Accept": "application/json"
        }
    })
        .then(response => response.json())
        .then(data => {
            data = data.courses;
            console.log(data);
            cbCourse.innerHTML = ``;
            cbCourse.appendChild(createOptionForSelect('0', 'Selecciona...'));
            data.forEach(course => {
                cbCourse.appendChild(createOptionForSelect(course.id, course.name));
            });
        });
}

function fillWhitProcess() {
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

function fillTableWhitCourses(area, course, process) {
    let formData = new FormData();
    formData.append('area', area);
    formData.append('course', course);
    formData.append('process', process);

    fetch('http://localhost/nivelation/app/controllers/student/getStudentsbyCourse.php/', {
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
            num = 1;
            data.forEach(std => {
                let row = table.createRow(num, std.dni, std.code,
                    (std.lastname + ' ' + std.name), std.school);
                // let btnShowStudent = button.createBtnPrimary('Ver', showStudentInfo, (std.lastname + ' ' + std.name));
                let btnShowStudent = createRedirectButton(std.stdID);
                row.appendChild(createCell(std.stat, std.num));
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

function createCell(text, numero) { //1 no nec, 2 si, pero no obl, 3 obl
    cell = document.createElement('td');
    span = document.createElement('span');
    span.innerText = text;
    span.classList.add('py-2');
    switch (parseInt(numero)) {
        case 1: { // No requiere
            span.classList.add('alert');
            span.classList.add('alert-success');
            break;
        }
        case 2: { // requiere, no obligatorio
            span.classList.add('alert');
            span.classList.add('alert-warning');
            break;
        }
        case 3: { // si requiere, obligatorio
            span.classList.add('alert');
            span.classList.add('alert-danger');
            break;
        }
        default: { // si requiere, obligatorio
            span.classList.add('badge');
            span.classList.add('badge-danger');
            break;
        }
    }
    cell.appendChild(span);
    return cell;
}

function showStudentInfo(fullname) {
    // let formData = new FormData();
    // formData.append('fullname', fullname);
    //
    // fetch('http://localhost/nivelation/bystudent.php', {
    //     method: 'POST',
    //     body: formData
    // })
    //     .then(response => response.text())
    //     .then(data => {
    //         if (data) {
    //             window.location = 'http://localhost/nivelation/bystudent.php';
    //         }
    //     }).catch(reason => {
    //     console.log(reason)
    // });

    // let url = 'http://localhost/nivelation/bystudent.php';
    // var form = document.createElement('form');
    // form.setAttribute('action', url);
    // form.setAttribute('method', 'POST');
    // var input = document.createElement('input');
    // input.setAttribute('name', 'fullname');
    // input.setAttribute('value', fullname);
    // form.appendChild(input);
    //
    // form.submit();
    // document.getElementById('aqui').appendChild(form);
    //window.location = url;
    //alert(fullname)
}

function createRedirectButton(id) {
    let url = "http://localhost/nivelation/bystudent.php";
    let btn = document.createElement('a');
    btn.classList.add('btn');
    btn.classList.add('btn-link');
    btn.setAttribute('href', `${url}?std=${id}`);
    btn.setAttribute('target', '_blank');
    btn.setAttribute('role', 'button');
    btn.innerText = 'Ver';
    return btn;
}