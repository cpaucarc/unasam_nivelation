const login_form = document.getElementById('login-form');


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
