const formPersonalInfo = document.getElementById('personal-info');
const formAccessInfo = document.getElementById('access-info');
const cbGender = document.getElementById('gender');

window.onload = () => {
    document.getElementById('view-title').innerText = 'Mi Perfil';
    selectGender();
}

formPersonalInfo.addEventListener('submit', (e) => {
    e.preventDefault();
    let formData = new FormData(formPersonalInfo);
    fetch('app/controllers/profile/updatePersonalInfo.php/', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            AlertConfirm(data.message, 'success', '¡Éxito!', 'primary');
        });
})

formAccessInfo.addEventListener('submit', (e) => {
    e.preventDefault();
    let formData = new FormData(formAccessInfo);
    fetch('app/controllers/profile/updateAccessInfo.php/', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            AlertConfirm(data.message, 'success', '¡Éxito!', 'primary');
        });
})

function selectGender() {
    let options = cbGender.querySelectorAll('option')
    options.forEach(opt => {
        if (opt.innerText === gender) {
            opt.setAttribute('selected', 'true');
        }
    })
}


//SweetAlert2
function AlertConfirm(message, tipe, title, variable) {
    if (message != '') {
        Swal.fire({
            icon: tipe,
            title: title,
            text: message,
            iconColor: 'var(--' + variable + ')',
            showCloseButton: true,
            confirmButtonColor: 'var(--' + variable + ')'
        })
    }
}

/* AlertConfirm(data.message, 'success', 'primary');
function AlertConfirm(message, tipe, variable) {
    if (message != '') {
        Swal.fire({
            icon: tipe,
            title: tipe.replace(/\b[a-z]/g,c=>c.toUpperCase())+'!',
            text: message,
            iconColor: 'var(--' + variable + ')',
            showCloseButton: true
        })
    }
} */