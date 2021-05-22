const date_start = document.getElementById('date_start');
const date_end = document.getElementById('date_end');
const modalGroupSize = document.getElementById('modalGroupSize');

const formGroup = document.getElementById('formGroup');
const formTeacher = document.getElementById('formTeacher');
const formScheduleToGroup = document.getElementById('formScheduleToGroup');
const formStudents = document.getElementById('formStudents');
const formSchedule = document.getElementById('formSchedule');

const tbody_schedule = document.getElementById('tbody-schedule');
const tbody_groups = document.getElementById('tbody-groups');
const tbody_teachers = document.getElementById('tbody-teachers');
const total_hours = document.getElementById('total_hours');

const cbProcess = document.getElementById('process');
const cbArea = document.getElementById('area');
const cbRooms = document.getElementById('rooms');

var schedules = [];
badge = new Badge();
table = new Table();
button = new Button();
select = new Select();
sweet = new SweetAlerts();

window.onload = () => {
    document.getElementById('view-title').innerText = 'Asignación de clases';
    date_start.valueAsDate = new Date();
    date_end.valueAsDate = new Date();
    fillScheduleTable();
    getAllProcess();
    getAllAreas();
    getAllGroups();
}

formGroup.onsubmit = (e) => {
    e.preventDefault();
    let groupData = new FormData(formGroup);
    fetch('app/controllers/classroom/CreateGroup.php/', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: groupData
    })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                document.getElementById('groupIDStep2').value = data.message;
                document.getElementById('groupIDStep3').value = data.message;
                document.getElementById('groupIDStep4').value = data.message;
                goToStep(2);
                getAllGroups();
                getTeacherByDim(groupData.get('dimension'));
            } else {
                sweet.warningAlert('¡Cuidado!', data.message);
            }
        });
}

formTeacher.onsubmit = (e) => {
    e.preventDefault();
    goToStep(3);
}

formScheduleToGroup.onsubmit = (e) => {
    e.preventDefault();
    goToStep(4);
}

formStudents.onsubmit = (e) => {
    e.preventDefault();
    goToStep(6);
}

formSchedule.onsubmit = (e) => {
    e.preventDefault();
    let dtSchd = new FormData(formSchedule);
    schedules.push(new Schedule(dtSchd.get('day'), dtSchd.get('time_start'), dtSchd.get('time_end')));
    fillScheduleTable();
    formSchedule.reset();
    btSaveSchedule.setAttribute('disabled', 'true');
}

function fillScheduleTable() {
    tbody_schedule.innerHTML = ``;
    console.log(schedules);
    let hours = 0;
    schedules.forEach(schd => {
        let btnDelete = button.createBtnDeleteNoText(deleteSchedule, schd.getId());
        let row = table.createRow(schd.getDay(), schd.getTimeStart(), schd.getTimeEnd(), `${schd.getHours()}h`);
        row.appendChild(table.createCell(btnDelete))
        tbody_schedule.appendChild(row);
        hours += schd.getHours();
    });
    total_hours.innerText = hours;
}

function deleteSchedule(id) {
    console.log(id)
    //openScheduleModal
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

function getAllGroups() {
    fetch('app/controllers/classroom/getAllGroups.php/', {
        method: 'GET',
        headers: {
            "Accept": "application/json"
        }
    })
        .then(response => response.json())
        .then(data => {
            data = data.groups;
            tbody_groups.innerHTML = ``;
            $('#table-groups').DataTable().clear().destroy();
            data.forEach((gr, i) => {
                let altstat = badge.createBadgeForGroup(gr.stat);
                let btnEdit = button.createBtnEdit(openEditGroupModal, gr);
                let btnStudent = button.createBtnPeople(openEditStudentsModal, gr);
                let group = button.createGroupButton(btnStudent, btnEdit);
                let row = table.createRow((i + 1), gr.teacher, gr.dimension, gr.process, gr.area, gr.amount, gr.date_start, gr.date_end);
                row.appendChild(table.createCell(altstat));
                row.appendChild(table.createCell(group));
                tbody_groups.appendChild(row);
            });
            $('#table-groups').DataTable();
        });
}

function getTeacherByDim(dim) {
    let data = new FormData();
    data.append('dimension', dim);
    fetch('app/controllers/teachers/getTeachersByDimID.php/', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: data
    })
        .then(response => response.json())
        .then(data => {
            data = data.teachers;
            tbody_teachers.innerHTML = ``;
            $('#table-teachers').DataTable().clear().destroy();
            data.forEach((tchr, i) => {
                let btnChoose = button.createBtnChoose(chooseTeacher, tchr);
                let row = table.createRow((i + 1), tchr.dni, tchr.teacher, tchr.course);
                row.appendChild(table.createCell(btnChoose));
                tbody_teachers.appendChild(row);
            });
            $('#table-teachers').DataTable();
        });
}

function getAllRooms() {
    fetch('app/controllers/classroom/getAllRooms.php/', {
        method: 'GET',
        headers: {
            "Accept": "application/json"
        }
    })
        .then(response => response.json())
        .then(data => {
            data = data.rooms;
            cbRooms.innerHTML = ``;
            cbRooms.appendChild(select.createOption(0, 'Selecciona...'));
            data.forEach(room => {
                cbRooms.appendChild(select.createOption(room.id, room.name));
            });
        });
}

function openEditGroupModal(group) {
    alert(group.teacher);
}

function openEditStudentsModal(group) {
    alert(group.teacher);
}

function chooseTeacher(teacher) {
    document.getElementById('teacherID').value = teacher.id;
    document.getElementById('teacherName').value = teacher.teacher;
    $('#modalTeacher').modal('hide');
}

function goToStep(num) {
    switch (num) {
        case 2: {
            //From formGroup (stp1) to formTeacher (stp2)
            showForm(formGroup, false);
            showForm(formTeacher, true);
            break;
        }
        case 3: {
            //From formTeacher (stp2) to formScheduleToGroup (stp3)
            showForm(formTeacher, false);
            showForm(formScheduleToGroup, true);
            break;
        }
        case 4: {
            //From formScheduleToGroup (stp3) to formStudents (stp4)
            showForm(formScheduleToGroup, false);
            showForm(formStudents, true);
            modalGroupSize.classList.remove('modal-sm');
            modalGroupSize.classList.add('modal-xl');
            break;
        }
        default: {
            showForm(formStudents, false);
            showForm(formGroup, true);
            $('#modalGroup').modal('hide');
            modalGroupSize.classList.remove('modal-xl');
            modalGroupSize.classList.add('modal-sm');
            break;
        }
    }
}

function showForm(form, show = true) {
    if (show) {
        form.classList.remove('d-none')
        form.classList.add('d-block')
    } else {
        form.classList.remove('d-block')
        form.classList.add('d-none')
    }
}