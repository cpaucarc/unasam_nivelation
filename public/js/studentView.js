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
select = new Select();

window.onload = function () {
    if (stdID > 0) {
        getStudentInfoByID(stdID);
        getCoursesByID(stdID);
    } else {
        stdInfoCard.innerHTML = '';
        notStdInfo.innerHTML = card.getNotStudentSelectedCard();
    }
    document.getElementById('view-title').innerText = 'Vista por Estudiante';
}

btSearch.addEventListener('click', (e) => {
    e.preventDefault();
    getStudentInfo(txSearch.value)
    getCoursesByFullname(txSearch.value)
})

txSearch.addEventListener('keyup', () => {
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
            fillStudentData(data);
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
            fillStudentData(data);
        });
}

function fillStudentData(data) {
    tbBody.innerHTML = '';
    let num = 1;
    data.forEach(c => {
        let row = table.createRow(num, c.course, `${c.percent}%`);
        row.appendChild(table.createCell(badge.createBadge(c.stat, c.num)));
        tbBody.appendChild(row);
        num++;
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
                data.lastname, data.name, data.program, data.dni, data.code, data.process, data.omg,
                data.omp, data.correct, data.incorrect, data.blank
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
                data.lastname, data.name, data.program, data.dni, data.code, data.process, data.omg,
                data.omp, data.correct, data.incorrect, data.blank
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