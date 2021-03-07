const login_form = document.getElementById('login-form');

login_form.addEventListener('submit', (e) => {
    e.preventDefault();
    let formData = FormData(login_form);

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
        });

})
