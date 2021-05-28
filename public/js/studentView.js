const stdInfoCard = document.getElementById('student-info-card');
const notStdInfo = document.getElementById('not-student-card');
const btSearch = document.getElementById('btSearch');
const txSearch = document.getElementById('txSearch');
const tbBody = document.getElementById('table-courses-body');
const tbBodyDim = document.getElementById('table-dimensions-body');
const tbody_basic_body = document.getElementById('tbody-dimensions-basic-body');
const tbQuestions1 = document.getElementById('questions-1');
const tbQuestions2 = document.getElementById('questions-2');
const stdID = parseInt(document.getElementById('stdID').value);

/*Report */

let byTipe = document.getElementById('byTipe');
let tipePdf = document.getElementById('tipePdf');
let navCourse = document.getElementById('navCourse');
let navDimension = document.getElementById('navDimension');
let navBasico = document.getElementById('navBasico');

let studentPdf = document.getElementById('studentPdf');
let studentChart = document.getElementById('studentChart');

card = new Card();
table = new Table();
badge = new Badge();
select = new Select();

window.onload = function () {
    if (stdID > 0) {
        getStudentInfoByID(stdID);
        getCoursesByID(stdID);
        getDimensionsByID(stdID);
        getBasicDimensionsByID(stdID);
    } else {
        stdInfoCard.innerHTML = '';
        notStdInfo.innerHTML = card.getNotStudentSelectedCard();
    }
    document.getElementById('view-title').innerText = 'Vista por Estudiante';
    tipePdf.innerHTML = 'basico';
    byTipe.value = 'basico';
}

navDimension.addEventListener('click', (e) => {
    e.preventDefault();
    byTipe.value = 'dimension';
    tipePdf.innerHTML = 'dimension';
});

navCourse.addEventListener('click', (e) => {
    e.preventDefault();
    byTipe.value = "curso";
    tipePdf.innerHTML = 'curso';
});
navBasico.addEventListener('click', (e) => {
    e.preventDefault();
    byTipe.value = "basico";
    tipePdf.innerHTML = 'basico';
});

btSearch.addEventListener('click', (e) => {
    e.preventDefault();
    getStudentInfo(txSearch.value);
    getCoursesByFullname(txSearch.value);
    getDimensionsByFullname(txSearch.value);
    getBasicDimensionsByFullname(txSearch.value);
})

txSearch.addEventListener('keyup', (e) => {
    getStudentsLike(txSearch.value);

    if (e.keyCode === 13) {
        e.preventDefault();
        getStudentInfo(txSearch.value);
        getCoursesByFullname(txSearch.value);
        getDimensionsByFullname(txSearch.value);
        getBasicDimensionsByFullname(txSearch.value);
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

function getDimensionsByFullname(fullname) {
    let formData = new FormData();
    formData.append('fullname', fullname);

    fetch(`${routeAux}app/controllers/student/getDimensionsOfStudent.php/`, {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            data = data.dimensions;
            fillStudentDimensions(data);
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

function getDimensionsByID(id) {
    let formData = new FormData();
    formData.append('stdID', id);

    fetch(`${routeAux}app/controllers/student/getDimensionsOfStudentByID.php/`, {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            data = data.dimensions;
            fillStudentDimensions(data);
        });
}

function getBasicDimensionsByID(id) {
    let formData = new FormData();
    formData.append('stdID', id);

    fetch(`${routeAux}app/controllers/student/getDimensionForLeveling.php/`, {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            data = data.dimensions;
            console.log('data');
            console.log(data);
            tbody_basic_body.innerHTML = ``;
            data.forEach((dim, i) => {
                let row = table.createRow((i + 1), dim.dimension);
                let alt = badge.createBadge(dim.stat, dim.num);
                row.appendChild(table.createCell(alt));
                row.appendChild(table.createCell(createForm(dim.id, dim.stdt)));
                tbody_basic_body.appendChild(row);
            })
        });
}

function createForm(dimID, stdtID) {
    let form = document.createElement('form');
    form.setAttribute('action', 'constancia');
    form.setAttribute('method', 'POST');
    form.setAttribute('target', '_blank');
    let stdInput = document.createElement('input');
    stdInput.value = stdtID;
    stdInput.setAttribute('type', 'hidden');
    stdInput.setAttribute('name', 'stdID');
    let dimInput = document.createElement('input');
    dimInput.value = dimID;
    dimInput.setAttribute('type', 'hidden');
    dimInput.setAttribute('name', 'dimID');
    let btn = document.createElement('button');
    btn.classList.add('btn');
    btn.classList.add('btn-light');
    btn.classList.add('btn-sm');
    btn.classList.add('text-dark');
    btn.innerHTML = '<i class="bi bi-file-earmark mr-1"></i>Constancia';
    btn.setAttribute('type', 'submit');
    form.appendChild(stdInput);
    form.appendChild(dimInput);
    form.appendChild(btn);
    return form;
}

function getBasicDimensionsByFullname(fullname) {
    let formData = new FormData();
    formData.append('fullname', fullname);

    fetch(`${routeAux}app/controllers/student/getDimensionForLevelingByFullName.php/`, {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            data = data.dimensions;
            console.log(data);
            tbody_basic_body.innerHTML = ``;
            data.forEach((dim, i) => {
                let row = table.createRow((i + 1), dim.dimension);
                let alt = badge.createBadge(dim.stat, dim.num);
                row.appendChild(table.createCell(alt));
                row.appendChild(table.createCell(createForm(dim.id, dim.stdt)));
                tbody_basic_body.appendChild(row);
            })
        });
}

function getQuestionsOfStudent(id) {
    let formData = new FormData();
    formData.append('stdID', id);

    fetch(`${routeAux}app/controllers/questions/getQuestionsOfStudent.php`, {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(questions => {
            let half = parseInt((questions.length) / 2);
            tbQuestions1.innerHTML = '';
            tbQuestions2.innerHTML = '';
            questions.forEach((question, i) => {
                let row = table.createRow(question.number, question.course, question.response);
                if (i < half) {
                    tbQuestions1.appendChild(row);
                } else {
                    tbQuestions2.appendChild(row);
                }
            })
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

function fillStudentDimensions(data) {
    tbBodyDim.innerHTML = '';
    let num = 1;
    data.forEach(dim => {
        let row = table.createRow(num, dim.dimension, `${dim.percent}%`);
        row.appendChild(table.createCell(badge.createBadge(dim.stat, dim.num)));
        tbBodyDim.appendChild(row);
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
            notStdInfo.innerHTML = '';

            stdInfoCard.innerHTML = card.getStudentInfoCard(data);
            studentPdf.value = data.id;
            studentChart.value = data.id;
        })
        .catch(function () {
            stdInfoCard.innerHTML = '';
            notStdInfo.innerHTML = card.getNotStudentSelectedCard();
            tbBody.innerHTML = '';
            studentPdf.value = '0';
            studentChart.value = '0';
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
            stdInfoCard.innerHTML = card.getStudentInfoCard(data);
            notStdInfo.innerHTML = '';
            studentPdf.value = data.id;
            studentChart.value = data.id;
        })
        .catch(function () {
            stdInfoCard.innerHTML = '';
            notStdInfo.innerHTML = card.getNotStudentSelectedCard();
            tbBody.innerHTML = '';
            studentPdf.value = '0';
            studentChart.value = '0';
        });
}

function setDataTables(table) {
    $(`#${table}`).DataTable();
}

function destroyDataTables(table) {
    $(`#${table}`).DataTable().clear().destroy();
}