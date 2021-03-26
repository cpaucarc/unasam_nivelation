/* ----- Constant ----- */
const user_form = document.getElementById('user-form');
const tbody = document.getElementById('table-body');

table = new Table();

/* ----- Window load ----- */
window.onload = function () {
    fillTableWhitAllUsers();
};

/* ----- Listeners ----- */
user_form.addEventListener('submit', (e) => {
    e.preventDefault();
    saveNewUser();
});

/* ----- Main Funcionts ----- */
function saveNewUser() {
    let formData = new FormData(user_form);

    fetch('http://localhost/nivelation/app/controllers/users/saveNewUser.php/', {
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
                // $('#tableUserView').load('app/views/users/tableUserView.php');
                $('#user_modal').modal("hide");
            }
            alert(data.message);
        });
}

function fillTableWhitAllUsers() {

    fetch('http://localhost/nivelation/app/controllers/users/getAllUsers.php/')
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

/* ----- Others Functions ----- */

function setDataTables(table) {
    $(`#${table}`).DataTable();
}

function destroyDataTables(table) {
    $(`#${table}`).DataTable().clear().destroy();
}
