const stdInfoCard = document.getElementById('student-info-card');
const notStdInfo = document.getElementById('not-student-card');
const btSearch = document.getElementById('btSearch');
const txSearch = document.getElementById('txSearch');
const tbBody = document.getElementById('table-courses-body');
const stdID = parseInt(document.getElementById('stdID').value);
card = new Card();

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
            destroyDataTables('example');
            tbBody.innerHTML = '';
            num = 1;
            data.forEach(c => {
                row = document.createElement('tr');
                row.appendChild(createCell(num));
                row.appendChild(createCell(c.course));
                row.appendChild(createCell(c.percent));
                row.appendChild(createCell(c.stat));
                tbBody.appendChild(row);
                num++;
            });

            setDataTables('example');
            console.log(data);
            console.log(data.courses);
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
            stdInfoCard.innerHTML = card.getStudentInfoCard(data.lastname, data.name, data.school, data.dni, data.code);
            notStdInfo.innerHTML = '';
        })
        .catch(function () {
            stdInfoCard.innerHTML = '';
            card.getNotStudentSelectedCard();
            tbBody.innerHTML = '';
        });
}

function createCell(text) {
    cell = document.createElement('td');
    cell.innerText = text;
    return cell;
}

function createButton() {
    button = document.createElement('button');
    button.classList.add('btn');
}

function setDataTables(table) {
    $(`#${table}`).DataTable();
}

function destroyDataTables(table) {
    $(`#${table}`).DataTable().clear().destroy();
}