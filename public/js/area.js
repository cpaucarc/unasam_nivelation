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

sweet = new SweetAlerts();
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
                if (data.status) {
                    showSchools(areaName);
                    formSchools.reset();
                    sweet.successAlert('¡Éxito!', data.message);
                    $('#SchoolModal').modal('hide');
                } else {
                    sweet.errorAlert('¡Error!', data.message);
                }
            });
    } else {
        sweet.warningAlert('¡Error!', 'Seleccione algun área en la parte superior.');
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
                if (data.status) {
                    showCourses(areaName);
                    formCourses.reset();
                    sweet.successAlert('¡Éxito!', data.message)
                    $('#CoursesModal').modal('hide');
                } else {
                    sweet.errorAlert('¡Error!', data.message);
                }
            });
    } else {
        sweet.waitAlert('¡Error!', 'Seleccione algun área en la parte superior.');
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
            if (data.status) {
                getAllAreas();
                formArea.reset();
                sweet.successAlert('¡Éxito!', data.message);
                $('#add-area').modal('hide');
            } else {
                sweet.errorAlert('¡Error!', data.message);
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