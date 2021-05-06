const newSchool = document.getElementById('newSchool');
const newCourse = document.getElementById('newCourse');
const areaNameCourse = document.getElementById('areaNameCourse');
const areaNameSchool = document.getElementById('areaNameSchool');
const tbodyCourses = document.getElementById('tbody-courses');
const tbodySchools = document.getElementById('tbody-schools');
const formSchools = document.getElementById('form-schools');
const formCourses = document.getElementById('form-courses');
const formArea = document.getElementById('form-area');
const areaIDSch = document.getElementById('areaIDSch');
const areaIDCou = document.getElementById('areaIDCou');
const cardAreas = document.getElementById('card-areas');
const btnAddCourse = document.getElementById('addCourse');
const cbCourses = document.getElementById('cbCourses');
var target = null;

button = new Button();
cardArea = new CardArea();
card = new Card();
column = new Column();
table = new Table();
var areaName = '';

window.onload = () => {
    appendAddNewAreasCard();
    getAllAreas();
    document.getElementById('view-title').innerText = 'Áreas';
}

btnAddCourse.addEventListener('click', () => {
    let formData = new FormData();
    formData.append('areaID', areaIDCou.value);
    fetch('app/controllers/courses/getCoursesNoAddedToArea.php/', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            data = data.courses;
            cbCourses.innerHTML = '';
            data.forEach(course => {
                let opt = document.createElement('option')
                opt.appendChild(document.createTextNode(course.name));
                cbCourses.appendChild(opt);
            })
        });
})

formSchools.addEventListener('submit', (e) => {
    e.preventDefault();
    if (areaName.trim().length > 0) {
        let formData = new FormData(formSchools);
        fetch('app/controllers/school/saveSchool.php/', {
            method: 'POST',
            headers: {
                "Accept": "application/json"
            },
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                /* alert(data.message); */
                if (data.status) {
                    showSchools(areaName);
                    formSchools.reset();
                    AlertConfirm(data.message, 'success', '¡Éxito!', 'primary');
                    $('#SchoolModal').modal('hide');
                } else {
                    AlertConfirm(data.message, 'error', '¡Error!', 'danger');
                }
            });
    } else {
        /*  alert('Seleccione algun área en la parte superior.'); */
        AlertConfirm('Seleccione algun área en la parte superior.', 'error', '¡Error!', 'danger');
    }
})

formCourses.addEventListener('submit', (e) => {
    e.preventDefault();
    if (areaName.trim().length > 0) {

        let formData = new FormData(formCourses);

        fetch('app/controllers/courses/addCourseToArea.php/', {
            method: 'POST',
            headers: {
                "Accept": "application/json"
            },
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                /* alert(data.message); */
                if (data.status) {
                    showCourses(areaName);
                    formCourses.reset();
                    AlertConfirm(data.message, 'success', '¡Éxito!', 'primary');
                    $('#CoursesModal').modal('hide');
                } else {
                    AlertConfirm(data.message, 'error', '¡Error!', 'danger');
                }
            });
    } else {
        /*  alert('Seleccione algun área en la parte superior.'); */
        AlertConfirm('Seleccione algun área en la parte superior.', 'error', '¡Error!', 'danger');
    }
})

formArea.addEventListener('submit', (e) => {
    e.preventDefault();
    let formData = new FormData(formArea);
    fetch('app/controllers/area/saveNewArea.php/', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            /*   alert(data.message); */
            if (data.status) {
                getAllAreas();
                formArea.reset();
                AlertConfirm(data.message, 'success', '¡Éxito!', 'primary');
                $('#add-area').modal('hide');
            }else{
                AlertConfirm(data.message, 'error', '¡Error!', 'danger');
            }
        });
})

function appendAreas(data) {
    data.forEach(area => {
        let btnShow = button.createIconAndTextBtn(
            '', ' Ver',
            showAreaCoursesAndSchools, area.name, area.id
        );
        let areaCard = cardArea.createCardArea(area.name, area.desc, btnShow);
        let div = column.createColumn(2);
        div.appendChild(areaCard);
        target.parentNode.insertBefore(div, target);
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
            appendAddNewAreasCard();
            data = data.areas;
            appendAreas(data);
        });
}

function showCourses(area) {
    let formData = new FormData();
    formData.append('area', area);

    fetch('app/controllers/courses/getCoursesByAreaAndLastProcess.php/', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            data = data.courses;
            tbodyCourses.innerHTML = ``;
            $('#table-courses').DataTable().clear().destroy();
            let num = 1;
            data.forEach(cs => {
                let row = table.createRow(num, cs.course, cs.process);
                tbodyCourses.appendChild(row);
                num++;
            });
            $('#table-courses').DataTable();
        });
}

function showSchools(area) {
    let formData = new FormData();
    formData.append('area', area);

    fetch('app/controllers/school/getSchoolsByArea.php/', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            data = data.programs;
            tbodySchools.innerHTML = ``;
            $('#table-schools').DataTable().clear().destroy();
            let num = 1;
            data.forEach(school => {
                let row = table.createRow(num, school.name);
                tbodySchools.appendChild(row);
                num++;
            });
            $('#table-schools').DataTable();
        });
}

function showAreaCoursesAndSchools(area, areaID) {
    areaName = area;
    areaNameCourse.innerText = area;
    areaNameSchool.innerText = area;
    areaIDSch.value = areaID;
    areaIDCou.value = areaID;
    showSchools(area);
    showCourses(area);
}

function appendAddNewAreasCard() {
    cardAreas.innerHTML = '';
    cardAreas.innerHTML = card.getAddNewAreaCard();
    target = document.querySelector('#div-new-area');
}



//SweetAlert2
function AlertConfirm(message, tipe, title, variable) {
    if (message != '') {
        Swal.fire({
            icon: tipe,
            title: title,
            text: message,
            iconColor: 'var(--' + variable + ')',
            showCloseButton: true,
            confirmButtonColor: 'var(--' + variable + ')'
        })
    }
}

/* AlertConfirm(data.message, 'success', 'primary');
function AlertConfirm(message, tipe, variable) {
    if (message != '') {
        Swal.fire({
            icon: tipe,
            title: tipe.replace(/\b[a-z]/g,c=>c.toUpperCase())+'!',
            text: message,
            iconColor: 'var(--' + variable + ')',
            showCloseButton: true
        })
    }
} */