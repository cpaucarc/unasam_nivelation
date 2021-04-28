const login_form = document.getElementById('login-form');
const cbRole = document.getElementById('role');

select = new Select();

window.onload = () => {
    fillWhitRoles();
    if (errormsg !== "") {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: errormsg,
            confirmButtonText:
                '<i class="bi bi-hand-thumbs-up mr-2"></i>Ok!',
            confirmButtonColor: 'var(--primary)',
        })
    }
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

// login_form.onsubmit = (e) => {
//     e.preventDefault();
//
//     let formData = new FormData(login_form);
//
//     try {
//         fetch('app/controllers/login/makeLogin.php/', {
//             method: 'POST',
//             headers: {
//                 "Accept": "application/json"
//             },
//             body: formData
//         })
//             .then(response => {
//                 if (response) {
//                     return response.json()
//                 } else {
//                     return null;
//                 }
//             })
//             .then(data => {
//                 if (data) {
//                     if (!data.status === "1") {
//                         alert(data.response);
//                     }
//                 }
//             });
//     } catch (e) {
//         alert('No se puede acceder al sistema');
//     }
// }
