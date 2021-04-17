const stdInfoCard = document.getElementById('student-info-card');
const notStdInfo = document.getElementById('not-student-card');
const btSearch = document.getElementById('btSearch');
const txSearch = document.getElementById('txSearch');
const tbBody = document.getElementById('table-courses-body');
const stdID = parseInt(document.getElementById('stdID').value);
const stdIDPDF = document.getElementById('stdIDPDF');
const btShowPDF = document.getElementById('btShowPDF');

card = new Card();
table = new Table();
badge = new Badge();

window.onload = function () {
    if (stdID > 0) {
        getStudentInfoByID(stdID);
        getCoursesByID(stdID);
    } else {
        // When std is not asigned
        stdInfoCard.innerHTML = '';
        notStdInfo.innerHTML = card.getNotStudentSelectedCard();
    }
}

btSearch.addEventListener('click', (e) => {
    e.preventDefault();
    //console.log(txSearch.value)
    getStudentInfo(txSearch.value)
    getCoursesByFullname(txSearch.value)
})

txSearch.addEventListener('keyup', () => {
    //console.log(txSearch.value)
    getStudentsLike(txSearch.value);
});

btShowPDF.addEventListener('click', () => {
    let id = parseInt(stdIDPDF.value);
    if (id > 0) {
        console.log('Mostrando PDF')
    }
});

function getStudentsLike(pattern) {
    let formData = new FormData();
    formData.append('pattern', pattern);

    fetch(`${routeAux}app/controllers/student/getStudentsLike.php/`, {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            data = data.students;
            let students = document.getElementById('students');
            students.innerHTML = '';
            data.forEach(std => {
                let opt = document.createElement('option');
                opt.value = std.student;
                students.appendChild(opt);
            })
        });
}

function getCoursesByFullname(fullname) {
    let formData = new FormData();
    formData.append('fullname', fullname);

    fetch(`${routeAux}app/controllers/student/getCoursesOfStudent.php/`, {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            data = data.courses;
            //destroyDataTables('table-courses');
            //$(`#table-courses`).DataTable().clear().destroy();
            tbBody.innerHTML = '';
            num = 1;
            data.forEach(c => {
                row = table.createRow(num, c.course, c.percent);
                row.appendChild(table.createCell(badge.createBadge(c.stat, c.num)));
                tbBody.appendChild(row);
                num++;
            });

            //$(`#table-courses`).DataTable();
        });
}

function getCoursesByID(id) {
    let formData = new FormData();
    formData.append('stdID', id);

    fetch(`${routeAux}app/controllers/student/getCoursesOfStudentByID.php/`, {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            data = data.courses;
            //$(`#table-courses`).DataTable().clear().destroy();
            tbBody.innerHTML = '';
            let num = 1;
            data.forEach(c => {
                let row = table.createRow(num, c.course, c.percent);
                row.appendChild(table.createCell(badge.createBadge(c.stat, c.num)));
                tbBody.appendChild(row);
                num++;
            });
            //$(`#table-courses`).DataTable();
        });
}

function getStudentInfoByID(id) {
    let formData = new FormData();
    formData.append('stdID', id);

    fetch(`${routeAux}app/controllers/student/getStudentInfoByID.php/`, {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            notStdInfo.innerHTML = '';
            stdInfoCard.innerHTML = card.getStudentInfoCard(
                data.lastname, data.name, data.school, data.dni, data.code, data.process
            );
            stdIDPDF.value = data.id;
        })
        .catch(function () {
            stdInfoCard.innerHTML = '';
            notStdInfo.innerHTML = card.getNotStudentSelectedCard();
            tbBody.innerHTML = '';
            stdIDPDF.value = '0';
        });
}

function getStudentInfo(fullname) {
    let formData = new FormData();
    formData.append('fullname', fullname);

    fetch(`${routeAux}app/controllers/student/getStudentInfo.php/`, {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            stdInfoCard.innerHTML = card.getStudentInfoCard(
                data.lastname, data.name, data.school, data.dni, data.code, data.process
            );
            notStdInfo.innerHTML = '';
            stdIDPDF.value = data.id;
        })
        .catch(function () {
            stdInfoCard.innerHTML = '';
            notStdInfo.innerHTML = card.getNotStudentSelectedCard();
            tbBody.innerHTML = '';
            stdIDPDF.value = '0';
        });
}

function setDataTables(table) {
    $(`#${table}`).DataTable();
}

function destroyDataTables(table) {
    $(`#${table}`).DataTable().clear().destroy();
}