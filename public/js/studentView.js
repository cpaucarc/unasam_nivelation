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
    if (stdID) {
        // When stdID > 0
        stdInfoCard.innerHTML = card.getStudentInfoCard('Paucar Colonia', 'Frank', 'Sistemas', '7412', '784512');
    } else {
        // When std is not asigned
        notStdInfo.innerHTML = card.getNotStudentSelectedCard();
    }


}

btSearch.addEventListener('click', (e) => {
    e.preventDefault();
    getCourses(txSearch.value)
})

function getCourses(id) {
    let formData = new FormData();
    formData.append('stdID', id);

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