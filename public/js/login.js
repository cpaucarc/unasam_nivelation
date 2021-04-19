const login_form = document.getElementById('login-form');

login_form.addEventListener('submit', (e) => {
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

})
