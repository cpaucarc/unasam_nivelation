const login_form = document.getElementById('login-form');
const cbRole = document.getElementById('role');

select = new Select();

window.onload = () => {
    fillWhitRoles();
}

function fillWhitRoles() {
    try {
        fetch('app/controllers/rol/getAllRoles.php/', {
            method: 'GET',
            headers: {
                "Accept": "application/json"
            }
        })
            .then(response => response.json())
            .then(data => {
                data = data.roles;
                cbRole.innerHTML = '';
                data.forEach(rol => {
                    cbRole.appendChild(select.createOption(rol.id, rol.type))
                })
            });
    } catch (e) {
        alert('No se puede acceder al sistema');
    }
}

login_form.onsubmit = (e) => {
    e.preventDefault();

    let formData = new FormData(login_form);

    try {
        fetch('app/controllers/login/makeLogin.php/', {
            method: 'POST',
            headers: {
                "Accept": "application/json"
            },
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === "1") {
                    window.location.href = "inicio";
                } else {
                    alert(data.response);
                }
            });
    } catch (e) {
        alert('No se puede acceder al sistema');
    }
}
