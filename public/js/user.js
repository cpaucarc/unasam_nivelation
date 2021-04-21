/* ----- Constant ----- */
const user_form = document.getElementById('user-form');
const rol_form = document.getElementById('rol-form');
const tbody = document.getElementById('table-body');
const cbUserRol = document.getElementById('user_rol');
const cbUserRoles = document.getElementById('user_roles');
const userDni = document.getElementById('user_dni')
const userUsername = document.getElementById('user_username')
const userPassword = document.getElementById('user_password')

table = new Table();
button = new Button();

/* ----- Window load ----- */
window.onload = function () {
    fillTableWhitAllUsers();
    getAllRoles(cbUserRol, null);
    document.getElementById('view-title').innerText = 'Usuarios Registrados';
};

/* ----- Listeners ----- */
user_form.addEventListener('submit', (e) => {
    e.preventDefault();
    saveNewUser();
});
rol_form.onsubmit = (e) => {
    e.preventDefault();
    let formData = new FormData(rol_form);
    fetch('app/controllers/users/updateRol.php/', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            console.log(data)
            if (data.status) {
                rol_form.reset();
                fillTableWhitAllUsers();
                $('#rol_modal').modal("hide");
            }
            alert(data.message);
        });
}
userDni.onkeyup = (e) => {
    userUsername.value = userDni.value;
    userPassword.value = userDni.value;
}

/* ----- Main Funcionts ----- */
function saveNewUser() {
    let formData = new FormData(user_form);
    fetch('app/controllers/users/saveNewUser.php/', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                user_form.reset();
                fillTableWhitAllUsers();
                $('#user_modal').modal("hide");
            }
            alert(data.message);
        });
}

function fillTableWhitAllUsers() {
    fetch('app/controllers/users/getAllUsers.php/')
        .then(response => response.json())
        .then(data => {
            data = data.users;
            $('#table-users').DataTable().clear().destroy();
            tbody.innerHTML = '';
            let num = 1;
            data.forEach(user => {
                let btnEdit = button.createBtnEdit(editUserRol, user.id, user.rol, `${user.lastname} ${user.name}`);
                let row = table.createRow(
                    num, user.dni, `${user.lastname} ${user.name}`,
                    user.rol, user.username
                );
                row.appendChild(table.createCell(btnEdit));
                tbody.appendChild(row);
                num++;
            });
            $('#table-users').DataTable();
        });
}

function getAllRoles(cbUserRol, valueSelected = null) {
    fetch('app/controllers/rol/getAllRoles.php/')
        .then(response => response.json())
        .then(data => {
            data = data.roles;
            fillSelectWithRoles(data, cbUserRol, valueSelected);
        });
}

function fillSelectWithRoles(roles, cb, valueSelected = null) {
    cb.innerHTML = '';
    roles.forEach(rol => {
        let opt = document.createElement('option');
        opt.setAttribute('value', rol.type);
        if (valueSelected !== null) {
            if (rol.type === valueSelected) {
                opt.setAttribute('selected', 'true');
            }
        }
        opt.appendChild(document.createTextNode(rol.type));
        cb.appendChild(opt);
    })
}

/* ----- Others Functions ----- */

function setDataTables(table) {
    $(`#${table}`).DataTable();
}

function destroyDataTables(table) {
    $(`#${table}`).DataTable().clear().destroy();
}

function editUserRol(id, rol, name) {
    document.getElementById('id_user').value = id;
    document.getElementById('span_username').innerText = name;
    getAllRoles(cbUserRoles, rol);
    $('#rol_modal').modal("show");
}