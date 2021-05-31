const btnNewDirector = document.getElementById('new-director');
const cbArea = document.getElementById('area');
const cbProgram = document.getElementById('program');
const cbGender = document.getElementById('gender');
const formDirector = document.getElementById('director-form');
const tbody = document.getElementById('table-body');

badge = new Badge();
button = new Button();
sweet = new SweetAlerts();
select = new Select();
table = new Table();

window.onload = () => {
    document.getElementById('view-title').innerText = 'Directores de Programas Académicos';
    getAllAreas();
    getAllDirectors();
}

btnNewDirector.onclick = () => {
    formDirector.reset();
}

cbArea.onchange = () => {
    let area = parseInt(cbArea.value);
    let areaName = cbArea.options[cbArea.selectedIndex].text;
    areaName = areaName.split(' - ')[0];
    if (area > 0) {
        getProgramsByArea(areaName);
    }
}

function getAllDirectors() {
    fetch('app/controllers/director/getAllDirectors.php', {
        method: 'GET',
        headers: {
            "Accept": "application/json"
        }
    })
        .then(response => response.json())
        .then(data => {
            data = data.directors;
            tbody.innerHTML = '';
            $('#table-directors').DataTable().clear().destroy();
            data.forEach((dir, i) => {
                let btnEdit = button.createBtnEdit(openModalForEdit, dir);
                let row = table.createRow((i + 1), dir.dni, `${dir.lastname} ${dir.name}`, dir.gender, dir.program, dir.area);
                row.appendChild(btnEdit)
                tbody.appendChild(row);
            });
            $('#table-directors').DataTable();
        });
}

formDirector.onsubmit = (e) => {
    e.preventDefault();
    let formData = new FormData(formDirector);
    fetch('app/controllers/director/saveDirector.php', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                getAllDirectors();
                $('#director_modal').modal('hide');
            } else {
                sweet.errorAlert('Error', data.message);
            }
        });
}

function getAllAreas(value = '') {
    cbArea.innerHTML = '';
    fetch('app/controllers/area/getAllAreas.php', {
        method: 'GET',
        headers: {
            "Accept": "application/json"
        }
    })
        .then(response => response.json())
        .then(data => {
            data = data.areas;
            if (value === '') {
                opt = select.createOption('0', 'Seleccione...');
                opt.setAttribute('selected', 'true');
                cbArea.appendChild(opt);
            }

            data.forEach(a => {
                opt = select.createOption(a.id, `${a.name} - ${a.desc}`);
                if (a.name === value) {
                    opt.setAttribute('selected', 'true');
                }
                cbArea.appendChild(opt);
            });
        });
}

function getProgramsByArea(area, value = '') {
    cbProgram.innerHTML = '';
    formData = new FormData();
    formData.append('area', area);
    fetch('app/controllers/school/getSchoolsByArea.php', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            data = data.programs;
            if (value === '') {
                opt = select.createOption('0', 'Seleccione...');
                opt.setAttribute('selected', 'true');
                cbProgram.appendChild(opt);
            }

            data.forEach(pg => {
                opt = select.createOption(pg.id, pg.name);
                if (pg.name === value) {
                    opt.setAttribute('selected', 'true');
                }
                cbProgram.appendChild(opt);
            });
        });
}

function openModalForEdit(director) {
    console.log(director)
    document.getElementById('directorID').value = director.id
    document.getElementById('dni').value = director.dni
    document.getElementById('name').value = director.name
    document.getElementById('lastname').value = director.lastname
    getAllAreas(director.area);
    getProgramsByArea(director.area, director.program);
    selectGender(director.gender);
    $('#director_modal').modal('show');
}

function selectGender(gender) {
    let options = cbGender.querySelectorAll('option')
    options.forEach(opt => {
        if (opt.innerText === gender) {
            opt.setAttribute('selected', 'true');
        }
    })
}