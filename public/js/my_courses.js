const listCourses = document.getElementById('list-courses');
const teacherID = document.getElementById('teacherID');
const groupID = document.getElementById('groupID');
const tbody_students = document.getElementById('tbody-students');
const tbody_schedule = document.getElementById('tbody-schedule');
const tbody_std_qlf = document.getElementById('tbody-std-qlf');
const classDataID = document.getElementById('classDataID');
const formClassData = document.getElementById('formClassData');
const formChangeQlf = document.getElementById('formChangeQlf');
const tablesView = document.getElementById('tableStudentsOfGroup');
const btnCreateQlf = document.getElementById('createQualifications');

sweet = new SweetAlerts();
badge = new Badge();
buttons = new Button();
table = new Table();
cards = new Card();

window.onload = () => {
    document.getElementById('view-title').innerText = 'Vista de mis cursos';
    getCourses();
}

formClassData.onsubmit = (e) => {
    e.preventDefault();
    let formData = new FormData(formClassData);
    fetch('app/controllers/attendance/registerNewClass.php', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            console.log(data)
            classDataID.value = data.message;
            showTablesWithStudents();
            getStudents(parseInt(classDataID.value));
        });
}

formChangeQlf.onsubmit = (e) => {
    e.preventDefault();
    let formData = new FormData(formChangeQlf);
    fetch('app/controllers/attendance/updateQualify.php', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                let auxAGrID = document.getElementById('infoGroupID').value
                getStudentsForQualification(auxAGrID);
                $('#modalChangeQlf').modal('hide');
            } else {
                sweet.errorAlert('Error', data.message);
            }
        });
}

btnCreateQlf.onclick = () => {
    let auxAGrID = document.getElementById('infoGroupID').value
    getStudentsForQualification(auxAGrID);
}

function getCourses() {
    let tID = parseInt(teacherID.value);
    if (tID > 0) {
        let formData = new FormData();
        formData.append('teacherID', tID);
        fetch('app/controllers/teachers/getCourses.php', {
            method: 'POST',
            headers: {
                "Accept": "application/json"
            },
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                console.log(data)
                if (data.length) {
                    listCourses.innerHTML = ``;
                    data = data.courses;
                    data.forEach(course => {
                        listCourses.appendChild(cards.getMyCourseCard(
                            course.dimensionName, course.groupName, course.areaName,
                            course, showModalInfoClass, showAttendanceModal));
                    })
                }
            });
    }
}

function getCurrentClassInfo(grID) {
    let formData = new FormData();
    formData.append('groupID', grID);
    fetch('app/controllers/attendance/getClassIDIfExist.php', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            console.log(data)
            classDataID.value = data.message;
            if (parseInt(data.message) > 0) {
                showTablesWithStudents();
                getStudents(parseInt(data.message));
                getCurrentClassTopic(parseInt(data.message));
            } else {
                hideTablesWithStudents();
            }

        });
}

function getCurrentClassTopic(classID) {
    let formData = new FormData();
    formData.append('classID', classID);
    fetch('app/controllers/attendance/getTopic.php', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            console.log(data)
            document.getElementById('topic').value = data.message;
        });
}

function getStudents(cldtID) {
    let formData = new FormData();
    formData.append('classDataID', cldtID);
    fetch('app/controllers/attendance/getStudentsOfClass.php', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            console.log(data)
            data = data.students;
            tbody_students.innerHTML = ``;
            data.forEach((std, i) => { //id, student, present, id
                let btn = buttons.getBtnAttendance(std.present, isPresent, std.id, std.present);
                let row = table.createRow((i + 1), std.student);
                row.appendChild(table.createCell(btn));
                tbody_students.appendChild(row);
            })
            getResume(data);
        });
}

function getStudentsForQualification(groupID) {
    let formData = new FormData();
    formData.append('groupID', groupID);
    fetch('app/controllers/attendance/registerQualificationsNGetStudents.php', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            console.log(data)
            data = data.students;
            tbody_std_qlf.innerHTML = ``;
            data.forEach((std, i) => { //id, student, qualification
                let btn = buttons.createBtnEdit(changeQualify, std);
                let stat = badge.createBadgeForQualify(std.qualification);
                let row = table.createRow((i + 1), std.student, std.qualification);
                row.appendChild(table.createCell(stat));
                row.appendChild(table.createCell(btn));
                tbody_std_qlf.appendChild(row);
            })
        });
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
            tbody_schedule.innerHTML = ``;
            data.forEach((std, i) => {
                let row = table.createRow((i + 1), std.day, std.time_start, std.time_end, std.classroom);
                tbody_schedule.appendChild(row);
            })
        });
}

function isPresent(id, num) {
    let formData = new FormData();
    formData.append('num', num);
    formData.append('attID', id);
    fetch('app/controllers/attendance/isPresent.php', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            console.log(data)

            if (data.status) {
                getStudents(parseInt(classDataID.value));
            }

        });
}

function getResume(data) {
    let total = data.length;
    let present = (data.filter(st => parseInt(st.present) === 1)).length;
    let absent = (data.filter(st => parseInt(st.present) === 0)).length;

    document.getElementById('std-present').innerText = present;
    document.getElementById('std-present-pct').innerText = (Math.round((present / total) * 100)) + "%";
    document.getElementById('std-absent').innerText = absent;
    document.getElementById('std-absent-pct').innerText = (Math.round((absent / total) * 100)) + "%";
    document.getElementById('std-total').innerText = total;
}

function showModalInfoClass(course) {
    console.log(course)
    //groupID, groupName, dimensionName, areaName, numStudents, id
    document.getElementById('infoArea').innerText = course.areaName;
    document.getElementById('infoCourse').innerText = course.dimensionName;
    document.getElementById('infoGroup').innerText = course.groupName;
    document.getElementById('infoNumStd').innerText = course.numStudents;
    document.getElementById('infoGroupID').value = course.groupID;
    getSchedules(course.groupID);
    $('#modalInfoClass').modal('show');
}

function showAttendanceModal(course) {
    clearFormData();
    document.getElementById('courseNameTitle').innerText = course.dimensionName;
    document.getElementById('groupNameTitle').innerText = course.groupName;
    document.getElementById('areaNameTitle').innerText = course.areaName;
    document.getElementById('groupID').value = course.groupID;
    getCurrentClassInfo(course.groupID);
    if (parseInt(classDataID.value) > 0) {
        console.log(classDataID.value)
        showTablesWithStudents()
        getStudents(parseInt(classDataID.value));
    } else {
        clearFormData();
    }
    $('#modalAttendance').modal('show');
}

function changeQualify(std) {
    //QlfID, student, qualification
    document.getElementById('changeQlfID').value = std.id;
    document.getElementById('changeStdName').innerText = std.student;
    document.getElementById('currentQlf').value = std.qualification;
    $('#modalChangeQlf').modal('show');
}

function showTablesWithStudents() {
    tablesView.classList.remove('d-none');
    tablesView.classList.add('d-block');
}

function hideTablesWithStudents() {
    tablesView.classList.remove('d-block');
    tablesView.classList.add('d-none');
}

function clearFormData() {
    document.getElementById('topic').value = ``;
    tbody_students.innerHTML = ``;
    hideTablesWithStudents();
}