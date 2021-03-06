const tbody = document.getElementById('tbody');
const txCourse = document.getElementById('course');
const courseID = document.getElementById('courseID');
const cbDimension = document.getElementById('dimension');
const formCourse = document.getElementById('form-course');
const formDimension = document.getElementById('form-dimension');
const btnNewCourse = document.getElementById('new-course');

table = new Table();
button = new Button();
sweet = new SweetAlerts();

window.onload = () => {
    getAllCourses();
    getAllDimensions();
    document.getElementById('view-title').innerText = 'Cursos';
}

btnNewCourse.onclick = () => {
    courseID.value = 0;
    txCourse.value = '';
}

formCourse.addEventListener('submit', (e) => {
    e.preventDefault();
    let formData = new FormData(formCourse);
    fetch('app/controllers/courses/saveCourse.php/', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                formCourse.reset();
                getAllCourses();
                sweet.successAlert('¡Éxito!', data.message);
                $('#courses_modal').modal('hide');
            } else {
                sweet.errorAlert('¡Error!', data.message)
            }
        });
});

formDimension.onsubmit = (e) => {
    e.preventDefault();
    formData = new FormData(formDimension);
    fetch('app/controllers/dimension/saveDimension.php/', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                formDimension.reset();
                getAllDimensions(formData.get('dimension'));
                sweet.successAlert('¡Éxito!', data.message);
                $('#modal-dimension').modal('hide');
            } else {
                sweet.errorAlert('¡Error!', data.message);
            }
        });
}

function getAllDimensions(valueSelected = null) {
    fetch('app/controllers/dimension/getAllDimensions.php/', {
        method: 'GET',
        headers: {
            "Accept": "application/json"
        }
    })
        .then(response => response.json())
        .then(data => {
            data = data.dimensions;
            cbDimension.innerHTML = ``;
            data.forEach(dim => {
                let opt = document.createElement('option')
                opt.appendChild(document.createTextNode(dim.name))
                if (valueSelected !== null) {
                    if (dim.name === valueSelected) {
                        opt.setAttribute('selected', 'true');
                    }
                }
                cbDimension.appendChild(opt)
            });
        });
}

function getAllCourses() {
    fetch('app/controllers/courses/getAllCourses.php/', {
        method: 'GET',
        headers: {
            "Accept": "application/json"
        }
    })
        .then(response => response.json())
        .then(data => {
            data = data.courses;
            tbody.innerHTML = ``;
            $('#table-courses').DataTable().clear().destroy();
            let num = 1;
            data.forEach(course => {
                let row = table.createRow(num, course.course, course.dimension);
                let btn = button.createBtnEdit(showModalForEditCourse, course.id, course.dimension, course.course);
                row.appendChild(table.createCell(btn));
                tbody.appendChild(row);
                num++;
            });
            $('#table-courses').DataTable();
        });
}

function showModalForEditCourse(id, dimension, course) {
    txCourse.value = course;
    courseID.value = id;
    getAllDimensions(dimension);
    $('#courses_modal').modal('show');
}