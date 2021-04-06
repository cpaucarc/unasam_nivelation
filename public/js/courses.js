const tbody = document.getElementById('tbody');
const txCourse = document.getElementById('course');
const courseID = document.getElementById('courseID');
const formCourse = document.getElementById('form-course');
table = new Table();
button = new Button();

window.onload = () => {
    getAllCourses();
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
            alert(data.message);
            if (data.status) {
                formCourse.reset();
                getAllCourses();
                $('#courses_modal').modal('hide');
            }
        });
});

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
                let row = table.createRow(num, course.name);
                let btn = button.createBtnEdit(showModalForEditCourse, course.id, course.name);
                row.appendChild(table.createCell(btn));
                tbody.appendChild(row);
                num++;
            });
            $('#table-courses').DataTable();
        });
}

function showModalForEditCourse(id, course) {
    txCourse.value = course;
    courseID.value = id;
    $('#courses_modal').modal('show');
}
