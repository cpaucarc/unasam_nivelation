const login_form = document.getElementById('login-form');

login_form.addEventListener('submit', (e) => {
    e.preventDefault();

    let formData = new FormData(login_form);

    fetch('http://localhost/nivelation/app/controllers/login/makeLogin.php/', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data.status === "1") {
                window.location.href = "http://localhost/nivelation/inicio";
            }
        });

})
