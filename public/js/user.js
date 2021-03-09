/* ----- Constant ----- */
const user_form = document.getElementById('user-form');
const tbody = document.getElementById('table-body');

/* ----- Window load ----- */
window.onload = function () {
    fillTableWhitAllUsers();
    setDataTables('tbUsers');

 /*    fillTableWhitAllUsers(); */
};

$(document).ready(function(){
    $('#tableUserView').load('app/views/users/tableUserView.php');
});

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
              /*   fillTableWhitAllUsers(); */
              $('#tableUserView').load('app/views/users/tableUserView.php');
              $('#user_modal').modal("toggle");
            }
            console.log(data.message);
        });
}

function deleteUser(id) {
    let formData = new FormData();
    formData.append('userID', id);

    fetch('http://localhost/nivelation/app/controllers/users/deleteUser.php/', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
               /*  fillTableWhitAllUsers(); */
               $('#tableUserView').load('app/views/users/tableUserView.php');
            }
            console.log(data.message);
        });
}

function fillTableWhitAllUsers() {

    fetch('http://localhost/nivelation/app/controllers/users/getAllUsers.php/')
        .then(response => response.json())
        .then(data => {
            data = data.users;
            // destroyDataTables('example');
            tbody.innerHTML = '';
            let num = 1;
            data.forEach(user => {
                row = document.createElement('tr');
                row.appendChild(createHTMLElement('th', num));
                row.appendChild(createHTMLElement('td', user.dni));
                row.appendChild(createHTMLElement('td', (user.lastname + ' ' + user.name)));
                row.appendChild(createHTMLElement('td', user.rol));
                row.appendChild(createHTMLElement('td', user.username));
                let btnDelete = createDeleteButton(deleteUser, user.id);
                row.appendChild(createHTMLElement('td', '').appendChild(btnDelete));
                tbody.appendChild(row);
                num++;
            });
            // setDataTables('example');
        });
}

/* ----- Others Functions ----- */
function createHTMLElement(type, text) {
    const element = document.createElement(type);
    element.innerText = text;
    return element;
}

function createButton(text, fun, param) {
    let button = document.createElement('button');
    button.innerText = text;
    button.addEventListener("click", function () {
        fun(param);
    }, false);
    return button;
}

function createDeleteButton(fun, param) {
    let btn = createButton('', fun, param);
    btn.innerHTML = '<i class="fas fa-trash"></i>';
    btn.classList.add("btn");
    btn.classList.add("btn-outline-danger");
    return btn;
}


function setDataTables(table) {
    $(`#${table}`).DataTable();
}

function destroyDataTables(table) {
    $(`#${table}`).DataTable().clear().destroy();
}
