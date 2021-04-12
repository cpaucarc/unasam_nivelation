/* ----- Constant ----- */
const user_form = document.getElementById('user-form');
const tbody = document.getElementById('table-body');
const cbUserRol = document.getElementById('user_rol');

table = new Table();

/* ----- Window load ----- */
window.onload = function () {
    fillTableWhitAllUsers();
    getAllRoles();
};

/* ----- Listeners ----- */
user_form.addEventListener('submit', (e) => {
    e.preventDefault();
    saveNewUser();
});

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
            console.log(data)
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
                let row = table.createRow(
                    num, user.dni, `${user.lastname} ${user.name}`,
                    user.rol, user.username
                );
                tbody.appendChild(row);
                num++;
            });
            $('#table-users').DataTable();
        });
}

function getAllRoles() {
    fetch('app/controllers/rol/getAllRoles.php/')
        .then(response => response.json())
        .then(data => {
            data = data.roles;
            fillSelectWithRoles(data);
        });
}

function fillSelectWithRoles(roles) {
    cbUserRol.innerHTML = '';
    roles.forEach(rol => {
        let opt = document.createElement('option');
        opt.appendChild(document.createTextNode(rol.name))
        cbUserRol.appendChild(opt);
    })
}

/* ----- Others Functions ----- */

function setDataTables(table) {
    $(`#${table}`).DataTable();
}

function destroyDataTables(table) {
    $(`#${table}`).DataTable().clear().destroy();
}
