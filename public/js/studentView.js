const stdInfoCard = document.getElementById('student-info-card');
const notStdInfo = document.getElementById('not-student-card');
const btSearch = document.getElementById('btSearch');
const txSearch = document.getElementById('txSearch');
const tbBody = document.getElementById('table-courses-body');
const stdID = parseInt(document.getElementById('stdID').value);
card = new Card();
table = new Table();

window.onload = function () {
    console.log('hello');
    console.log(stdID);
    if (!stdID === '') {
        // When stdID > 0
        notStdInfo.innerHTML = '';
        stdInfoCard.innerHTML = card.getStudentInfoCard('Paucar Colonia', 'Frank', 'Sistemas', '7412', '784512');

    } else {
        // When std is not asigned
        stdInfoCard.innerHTML = '';
        notStdInfo.innerHTML = card.getNotStudentSelectedCard();
    }
}

btSearch.addEventListener('click', (e) => {
    //e.preventDefault();
    //console.log(txSearch.value)
    getStudentInfo(txSearch.value)
    getCourses(txSearch.value)
})

txSearch.addEventListener('keyup', () => {
    //console.log(txSearch.value)
    getStudentsLike(txSearch.value);
});


function getStudentsLike(pattern) {
    let formData = new FormData();
    formData.append('pattern', pattern);

    fetch('http://localhost/nivelation/app/controllers/student/getStudentsLike.php/', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            data = data.students;
            students = document.getElementById('students');
            students.innerHTML = '';
            console.log(data);
            data.forEach(std => {
                opt = document.createElement('option');
                opt.value = std.student;
                students.appendChild(opt);
            })
        });
}

function getCourses(fullname) {
    let formData = new FormData();
    formData.append('fullname', fullname);

    fetch('http://localhost/nivelation/app/controllers/student/getCoursesOfStudent.php/', {
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
                row.appendChild(createCell(c.stat, c.num));
                tbBody.appendChild(row);
                num++;
            });

            //$(`#table-courses`).DataTable();
        });
}

function getStudentInfo(fullname) {
    let formData = new FormData();
    formData.append('fullname', fullname);

    fetch('http://localhost/nivelation/app/controllers/student/getStudentInfo.php/', {
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
        })
        .catch(function () {
            stdInfoCard.innerHTML = '';
            card.getNotStudentSelectedCard();
            tbBody.innerHTML = '';
        });
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

function setDataTables(table) {
    $(`#${table}`).DataTable();
}

function destroyDataTables(table) {
    $(`#${table}`).DataTable().clear().destroy();
}