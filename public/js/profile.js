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
            alert(data.message);
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
            alert(data.message);
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