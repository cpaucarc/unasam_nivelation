const directorID = document.getElementById('directorID');
const programID = document.getElementById('programID');
const cbProcess = document.getElementById('process');
const listCourses = document.getElementById('list-courses');
const tbodyStudents = document.getElementById('tbody-students');
const tbodySchedule = document.getElementById('tbody-schedule');

card = new Card();
table = new Table();
select = new Select();
badge = new Badge();

window.onload = () => {
    getProgramID();
    fillWhitProcess()
}

cbProcess.onchange = () => {
    //llamar a traer cursos
    let procId = parseInt(cbProcess.value);
    if (procId > 0) {
        getCoursesOfProgram(procId);
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

function getProgramID() {
    let formData = new FormData();
    formData.append('directorID', directorID.value);
    fetch('app/controllers/tracing/getProgramOFDirector.php', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                programID.value = data.message;
            }
        });
}

function getCoursesOfProgram(procID) {
    let formData = new FormData();
    formData.append('programID', programID.value);
    formData.append('proccessID', procID);
    fetch('app/controllers/tracing/getCoursesOfProgram.php', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            data = data.dimensions;
            console.log(data)
            listCourses.innerHTML = ``;
            if (data.length > 0) {
                data.forEach(cs => {
                    //groupID, groupName, dimName, id
                    listCourses.appendChild(card.getCoursesOfProgramCard(cs.dimName, cs.groupName, cs, showInfoModal, showStudentsModal));
                })
            } else {
                listCourses.appendChild(card.getImageIfNotExistCourses());
            }
        });
}


function getStudents(groupID) {
    let formData = new FormData();
    formData.append('programID', programID.value);
    formData.append('groupID', groupID);
    fetch('app/controllers/tracing/getStudentsOfProgramByGroup.php', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            data = data.students;
            console.log(data)
            tbodyStudents.innerHTML = ``;
            if (data.length > 0) {
                data.forEach((std, i) => {
                    //id, code, student, phone, email, address, percent
                    let stat = badge.createBadgeForPercet(std.percent)
                    let row = table.createRow((i + 1), std.code, std.student, std.phone, std.email, std.address);
                    row.appendChild(table.createCell(stat));
                    tbodyStudents.appendChild(row);
                })
            }
        });
}


function showStudentsModal(course) {
    console.log('Modal: ' + course)
    getStudents(course.groupID);
    $('#modalTracing').modal('show');
}

function showInfoModal(course) {
    console.log('Info: ' + course.groupID)
    document.getElementById('infoGroup').innerText = course.groupName;
    document.getElementById('infoCourse').innerText = course.dimName;
    document.getElementById('infoTeacher').innerText = course.teacher;
    document.getElementById('infoArea').innerText = course.areaName;
    document.getElementById('infoDateStart').innerText = course.date_start;
    document.getElementById('infoDateEnd').innerText = course.date_end;
    document.getElementById('infoGroupID').value = course.groupID;
    getSchedules(course.groupID);
    $('#modalInfoClass').modal('show');
}

function getSchedules(groupID) {
    let formData = new FormData();
    formData.append('groupID', groupID);
    fetch('app/controllers/attendance/getSchedulesOfClass.php', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            console.log(data)
            data = data.schedules;
            tbodySchedule.innerHTML = ``;
            data.forEach((std, i) => {
                let row = table.createRow((i + 1), std.day, std.time_start, std.time_end, std.classroom);
                tbodySchedule.appendChild(row);
            })
        });
}