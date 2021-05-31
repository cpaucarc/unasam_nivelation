const date_start = document.getElementById('date_start');
const date_end = document.getElementById('date_end');
const btnNewGroup = document.getElementById('newGroup');
const modalGroupSize = document.getElementById('modalGroupSize');

const formGroup = document.getElementById('formGroup');
const formScheduleToGroup = document.getElementById('formScheduleToGroup');
const formStudents = document.getElementById('formStudents');
const formSchedule = document.getElementById('formSchedule');

const tbody_schedule = document.getElementById('tbody-schedule');
const tbody_groups = document.getElementById('tbody-groups');
const tbody_teachers = document.getElementById('tbody-teachers');
const tbody_student_wog = document.getElementById('tbody-student-wog');
const tbody_student_wg = document.getElementById('tbody-student-wg');
const total_hours = document.getElementById('total_hours');

const cbProcess = document.getElementById('process');
const cbArea = document.getElementById('area');
const cbRooms = document.getElementById('rooms');
const cbDimension = document.getElementById('dimension');
const txTeacher = document.getElementById('teacherName');
const showAllTeachers = document.getElementById('showAllTeachers');

const groupIDStep2 = document.getElementById('groupIDStep2');
const groupIDStep3 = document.getElementById('groupIDStep3');
const groupIDSchedule = document.getElementById('groupIDSchedule');

var schedules = [];
badge = new Badge();
table = new Table();
button = new Button();
select = new Select();
sweet = new SweetAlerts();

window.onload = () => {
    document.getElementById('view-title').innerText = 'Asignación de grupos de clases';
    resetForm();
    getAllProcess();
    getAllAreas();
    getAllGroups();
}
cbDimension.onchange = () => {
    getTeacherByDim(cbDimension.value);
    countGroupName(cbProcess.value, cbDimension.value, cbArea.value);
}
cbProcess.onchange = () => {
    countGroupName(cbProcess.value, cbDimension.value, cbArea.value);
}
cbArea.onchange = () => {
    countGroupName(cbProcess.value, cbDimension.value, cbArea.value);
}
btnNewGroup.onclick = () => {
    goToStep(1);
}

formGroup.onsubmit = (e) => {
    e.preventDefault();
    let groupData = new FormData(formGroup);
    fetch('app/controllers/classroom/createGroup.php/', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: groupData
    })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                if (parseInt(data.message) !== -1) {
                    groupIDStep2.value = data.message;
                    groupIDStep3.value = data.message;
                    groupIDSchedule.value = data.message;
                    getScheduleOfGroup(parseInt(data.message));
                } else {
                    getScheduleOfGroup(parseInt(document.getElementById('groupID').value));
                }
                goToStep(2);
                getAllGroups();
                getAllRooms();
            } else {
                sweet.warningAlert('¡Cuidado!', data.message);
            }
        });
}

formScheduleToGroup.onsubmit = (e) => {
    e.preventDefault();
    goToStep(3);
    getStudentsWithoutGroup(parseInt(groupIDStep2.value));
    getStudentsInGroup(parseInt(groupIDStep2.value));
}

formStudents.onsubmit = (e) => {
    e.preventDefault();
    goToStep(4);
}

formSchedule.onsubmit = (e) => {
    e.preventDefault();
    let dataSchd = new FormData(formSchedule);

    fetch('app/controllers/classroom/createNewSchedule.php/', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: dataSchd
    })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                getScheduleOfGroup(parseInt(groupIDSchedule.value));
                $('#modalSchedule').modal('hide');
            } else {
                sweet.errorAlert('¡Error!', data.message);
            }
        });
}

txTeacher.onclick = () => {
    // getTeacherByDim(cbDimension.value);
    controlCheckForShowTeachers(cbDimension.value);
}

showAllTeachers.onchange = () => {
    controlCheckForShowTeachers(cbDimension.value);
}

function getAllProcess(value = '') {
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
                let opt = select.createOption(proc.id, proc.name);
                if (value !== '' && value === proc.name) {
                    opt.setAttribute('selected', 'true');
                }
                cbProcess.appendChild(opt);
            });
        });
}

function getAllAreas(value = '') {
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
                let opt = select.createOption(area.id, area.name);
                if (value !== '' && value === area.name) {
                    opt.setAttribute('selected', 'true');
                }
                cbArea.appendChild(opt);
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
            console.log(data)
            tbody_groups.innerHTML = ``;
            $('#table-groups').DataTable().clear().destroy();
            data.forEach((gr, i) => {
                let altstat = badge.createBadgeForGroup(gr.stat);
                let btnEdit = table.createColumn();
                if (parseInt(gr.stat) !== 3) {
                    btnEdit = button.createBtnEdit(openEditGroupModal, gr);
                }
                let row = table.createRow((i + 1), gr.group_name, gr.teacher, gr.dimension, gr.process, gr.area, gr.amount, gr.date_start, gr.date_end);
                row.appendChild(table.createCell(altstat));
                row.appendChild(table.createCell(btnEdit));
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

function getAllTeachers() {
    fetch('app/controllers/teachers/getTeacherParcial.php/', {
        method: 'GET',
        headers: {
            "Accept": "application/json"
        }
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

function controlCheckForShowTeachers(dim = 0) {
    if (showAllTeachers.checked) {
        getAllTeachers();
        // showAllTeachers.checked = false;
    } else {
        if (parseInt(dim) > 0) {
            getTeacherByDim(dim);
        } else {
            getAllTeachers();
        }
        // showAllTeachers.checked = true;
    }
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

function countGroupName(proc, dim, area) {
    if (parseInt(proc) > 0 && parseInt(dim) > 0 && parseInt(area) > 0) {
        let formData = new FormData();
        formData.append('dimension', dim);
        formData.append('area', area);
        formData.append('process', proc);
        fetch('app/controllers/classroom/countGroupName.php/', {
            method: 'POST',
            headers: {
                "Accept": "application/json"
            },
            body: formData
        })
            .then(response => response.text())
            .then(data => {
                document.getElementById('groupName').value = `Grupo 0${data}`;
            });
    }
}

function getScheduleOfGroup(groupID) {
    let formData = new FormData;
    formData.append('groupID', groupID);
    fetch('app/controllers/classroom/getSchedulesByGroup.php/', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            data = data.schedules;
            tbody_schedule.innerHTML = ``;
            let hours = 0;
            data.forEach((schd, i) => {
                let btnDelete = button.createBtnDeleteNoText(deleteSchedule, schd.id)
                let row = table.createRow((i + 1), schd.days, schd.time_start, schd.time_end, `${schd.hours}h`, schd.room);
                row.appendChild(table.createCell(btnDelete));
                tbody_schedule.appendChild(row);
                hours += parseInt(schd.hours);
            });
            total_hours.innerText = hours
        });
}

function getStudentsWithoutGroup(groupID) {
    let formData = new FormData();
    formData.append('groupID', groupID);
    fetch('app/controllers/classroom/getStudentsWithoutGroup.php/', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            data = data.students;
            tbody_student_wog.innerHTML = ``;
            $('#table-student-wog').DataTable().clear().destroy();
            data.forEach((st, i) => {
                let btnChoose = button.createBtnChoose(chooseStudent, st);
                let row = table.createRow((i + 1), st.student, st.program, st.score);
                row.appendChild(table.createCell(btnChoose));
                tbody_student_wog.appendChild(row);
            });
            $('#table-student-wog').DataTable();
        });
}

function getStudentsInGroup(groupID) {
    let formData = new FormData();
    formData.append('groupID', groupID);
    fetch('app/controllers/classroom/getStudentsInGroup.php/', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            data = data.students;
            tbody_student_wg.innerHTML = ``;
            $('#table-student-wg').DataTable().clear().destroy();
            data.forEach((st, i) => {
                let btnChoose = button.createBtnDeleteNoText(removeStudent, st);
                let row = table.createRow((i + 1), st.student, st.program, st.score);
                row.appendChild(table.createCell(btnChoose));
                tbody_student_wg.appendChild(row);
            });
            $('#table-student-wg').DataTable();
            document.getElementById('countStudents').innerText = data.length;
        });
}

function openEditGroupModal(group) {
    console.log(group)
    goToStep(5);
    groupIDStep2.value = group.id;
    groupIDStep3.value = group.id;
    groupIDSchedule.value = group.id;
    document.getElementById('groupID').value = group.id;
    document.getElementById('teacherID').value = group.id_teacher;
    document.getElementById('teacherName').value = group.teacher;
    document.getElementById('groupName').value = group.group_name;
    date_start.valueAsDate = new Date(changeFormatOfDate(group.date_start));
    date_end.valueAsDate = new Date(changeFormatOfDate(group.date_end));
    dateHelp.innerText = '';
    getAllProcess(group.process);
    getAllAreas(group.area);
    selectDimension(group.dimension);
    $('#modalGroup').modal('show');
}

function openEditStudentsModal(group) {
    alert(group.teacher);
}

function chooseTeacher(teacher) {
    document.getElementById('teacherID').value = teacher.id;
    document.getElementById('teacherName').value = teacher.teacher;
    $('#modalTeacher').modal('hide');
}

function chooseStudent(student) {
    let chStd = new FormData();
    chStd.append('stdtID', student.id);
    chStd.append('groupID', groupIDStep3.value);

    fetch('app/controllers/classroom/addStudentToGroup.php/', {
        method: 'POST',
        body: chStd
    })
        .then(response => response.text())
        .then(data => {
            if (parseInt(data) === 1) {
                getStudentsWithoutGroup(parseInt(chStd.get('groupID')));
                getStudentsInGroup(parseInt(chStd.get('groupID')));
            }
        });
}

function removeStudent(student) {
    let delStd = new FormData();
    delStd.append('stgrID', student.id);

    fetch('app/controllers/classroom/removeStudentFromGroup.php/', {
        method: 'POST',
        body: delStd
    })
        .then(response => response.text())
        .then(data => {
            if (parseInt(data) === 1) {
                getStudentsWithoutGroup(parseInt(groupIDStep3.value));
                getStudentsInGroup(parseInt(groupIDStep3.value));
            }
        });
}

function deleteSchedule(scheduleID) {
    let dltSchd = new FormData();
    dltSchd.append('scheduleID', scheduleID);

    fetch('app/controllers/classroom/deleteSchedule.php/', {
        method: 'POST',
        body: dltSchd
    })
        .then(response => response.text())
        .then(data => {
            getScheduleOfGroup(parseInt(groupIDStep2.value));
        });
}

function resetForm() {
    groupIDStep2.value = '0';
    groupIDStep3.value = '0';
    groupIDSchedule.value = '0';
    document.getElementById('groupID').value = '0';
    document.getElementById('teacherID').value = '0';
    document.getElementById('teacherName').value = '';
    document.getElementById('groupName').value = 'Grupo 01';
    date_start.valueAsDate = new Date();
    date_end.valueAsDate = new Date();
}

function goToStep(num) {
    switch (num) {
        case 2: {
            //From formGroup (stp1) to formScheduleToGroup (stp2)
            showForm(formGroup, false);
            showForm(formScheduleToGroup, true);
            break;
        }
        case 3: {
            //From formScheduleToGroup (stp2) to formStudents (stp3)
            showForm(formScheduleToGroup, false);
            showForm(formStudents, true);
            modalGroupSize.classList.remove('modal-md');
            modalGroupSize.classList.add('modal-xl');
            break;
        }
        default: {
            showForm(formStudents, false);
            showForm(formGroup, true);
            $('#modalGroup').modal('hide');
            resetForm();
            modalGroupSize.classList.remove('modal-xl');
            modalGroupSize.classList.add('modal-md');
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

function selectDimension(value) {
    let dim = document.getElementById('dimension');
    let opts = dim.querySelectorAll('option');
    opts.forEach(opt => {
        if (opt.innerText === value) {
            opt.setAttribute('selected', 'true');
        }
    })
}

function changeFormatOfDate(value) {
    console.log(value)
    let formatedDate = value.split('/');
    console.log(formatedDate)
    return `20${formatedDate[2]}-${formatedDate[1]}-${formatedDate[0]}`;
}