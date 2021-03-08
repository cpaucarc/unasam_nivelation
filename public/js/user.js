/* ----- Constant ----- */
const user_form = document.getElementById('user-form');

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
                fillTableWhitAllUsers();
            }
            console.log(data.message);
        });
}

function fillTableWhitAllUsers() {

    const tbody = document.getElementById('table-body');
    tbody.innerHTML = '';

    fetch('http://localhost/nivelation/app/controllers/users/getAllUsers.php/', {
        method: 'GET',
        headers: {
            "Accept": "application/json"
        }
    })
        .then(response => response.json())
        .then(data => {
            data = data.users;
            let num = 1;
            data.forEach(user => {
                const row = document.createElement('tr');
                row.appendChild(createHTMLElement('th', num));
                row.appendChild(createHTMLElement('td', user.dni));
                row.appendChild(createHTMLElement('td', (user.lastname + ' ' + user.name)));
                row.appendChild(createHTMLElement('td', user.rol));
                row.appendChild(createHTMLElement('td', user.username));
                let btnDelete = createDeleteButton(deleteUser, user.id);
                row.appendChild(createHTMLElement('td', '').appendChild(btnDelete));
                tbody.appendChild(row);
                num++;
            })
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


