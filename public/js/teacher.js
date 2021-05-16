const tbody = document.getElementById('table-body');
const cbCourse = document.getElementById('course');
const cbArea = document.getElementById('area');
const cbProgram = document.getElementById('program');
const cbGender = document.getElementById('gender');
const btnNewTeacher = document.getElementById('new-teacher');
const formTeacher = document.getElementById('teacher-form');
const formJob = document.getElementById('job-form');

badge = new Badge();
table = new Table();
button = new Button();
select = new Select();
sweet = new SweetAlerts();

window.onload = () => {
    document.getElementById('view-title').innerText = 'Docentes';
    getAllTeachers();
    getAllCourses();
    getAllAreas();
}

formTeacher.onsubmit = (e) => {
    e.preventDefault();
    let formData = new FormData(formTeacher);
    fetch('app/controllers/teachers/saveTeacher.php', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                sweet.successAlert('Exito', data.message);
                formTeacher.reset();
                getAllTeachers();
                $('#teacher_modal').modal('hide');
            } else {
                sweet.errorAlert('Error', data.message);
            }
        });
}

formJob.onsubmit = (e) => {
    e.preventDefault();
    let formData = new FormData(formJob);
    fetch('app/controllers/teachers/updateJobStatus.php', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                getAllTeachers();
                $('#job_modal').modal('hide');
            } else {
                sweet.errorAlert('Error', data.message);
            }
        });
}

btnNewTeacher.onclick = () => {
    document.getElementById('submit').value = 'Registrar Nuevo Docente';
    formTeacher.reset();
}

cbArea.onchange = () => {
    let area = parseInt(cbArea.value);
    let areaName = cbArea.options[cbArea.selectedIndex].text;
    areaName = areaName.split(' - ')[0];
    if (area > 0) {
        getProgramsByArea(areaName);
    }
}

function getAllTeachers() {
    fetch('app/controllers/teachers/getAllTeachers.php', {
        method: 'GET',
        headers: {
            "Accept": "application/json"
        }
    })
        .then(response => response.json())
        .then(data => {
            data = data.teachers;
            fillTable(data);
        });
}

function getAllCourses(value = '') {
    let opt;
    cbCourse.innerHTML = '';
    fetch('app/controllers/courses/getAllCourses.php', {
        method: 'GET',
        headers: {
            "Accept": "application/json"
        }
    })
        .then(response => response.json())
        .then(data => {
            data = data.courses;

            if (value === '') {
                opt = select.createOption('0', 'Seleccione...');
                opt.setAttribute('selected', 'true');
                cbCourse.appendChild(opt);
            }

            data.forEach(c => {
                opt = select.createOption(c.id, c.course);
                if (c.course === value) {
                    opt.setAttribute('selected', 'true');
                }
                cbCourse.appendChild(opt);
            });
        });
}

function getAllAreas(value = '') {
    cbArea.innerHTML = '';
    fetch('app/controllers/area/getAllAreas.php', {
        method: 'GET',
        headers: {
            "Accept": "application/json"
        }
    })
        .then(response => response.json())
        .then(data => {
            data = data.areas;
            if (value === '') {
                opt = select.createOption('0', 'Seleccione...');
                opt.setAttribute('selected', 'true');
                cbArea.appendChild(opt);
            }

            data.forEach(a => {
                opt = select.createOption(a.id, `${a.name} - ${a.desc}`);
                if (a.name === value) {
                    opt.setAttribute('selected', 'true');
                }
                cbArea.appendChild(opt);
            });
        });
}

function getProgramsByArea(area, value = '') {
    cbProgram.innerHTML = '';
    formData = new FormData();
    formData.append('area', area);
    fetch('app/controllers/school/getSchoolsByArea.php', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            data = data.programs;
            if (value === '') {
                opt = select.createOption('0', 'Seleccione...');
                opt.setAttribute('selected', 'true');
                cbProgram.appendChild(opt);
            }

            data.forEach(pg => {
                opt = select.createOption(pg.id, pg.name);
                if (pg.name === value) {
                    opt.setAttribute('selected', 'true');
                }
                cbProgram.appendChild(opt);
            });
        });
}

function selectGender(gender) {
    let options = cbGender.querySelectorAll('option')
    options.forEach(opt => {
        if (opt.innerText === gender) {
            opt.setAttribute('selected', 'true');
        }
    })
}

function fillTable(data) {
    tbody.innerHTML = '';
    $('#table-teachers').DataTable().clear().destroy();
    data.forEach((teacher, i) => {
        let btnEdit = button.createBtnEdit(openModalForEdit, teacher);
        let btnJob = button.createBtnJob(openModalForJob, teacher);
        let status = badge.createBadgeForJob(teacher.status_name, teacher.status);
        let column = table.createColumn();
        column.appendChild(button.createGroupButton(btnEdit, btnJob));
        let row = table.createRow((i + 1), teacher.dni, `${teacher.lastname} ${teacher.name}`, teacher.gender, teacher.course, teacher.program, teacher.area);
        row.appendChild(table.createCell(status))
        row.appendChild(column)
        tbody.appendChild(row);
    });
    $('#table-teachers').DataTable();
}

function openModalForEdit(teacher) {
    console.log(teacher)
    document.getElementById('teacherID').value = teacher.id
    document.getElementById('dni').value = teacher.dni
    document.getElementById('name').value = teacher.name
    document.getElementById('lastname').value = teacher.lastname
    document.getElementById('submit').value = 'Editar Información del docente';
    getAllCourses(teacher.course);
    getAllAreas(teacher.area);
    getProgramsByArea(teacher.area, teacher.program);
    selectGender(teacher.gender);
    $('#teacher_modal').modal('show');
}

function openModalForJob(teacher) {
    document.getElementById('teacher').innerText = `${teacher.lastname} ${teacher.name}`;
    document.getElementById('teacherJobID').value = teacher.id;
    let current = document.getElementById('current');
    current.innerHTML = '';
    current.appendChild(badge.createBadgeForJob(teacher.status_name, teacher.status));
    $('#job_modal').modal('show');
}