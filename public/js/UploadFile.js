let barra_estado = document.querySelector('#barra_estado'),
    btn_cancelar = document.querySelector('#btn_cancelar');

let file = document.querySelector('#file'), extPermitidas;
const lastProcess = document.getElementById('lastProcess');

document.addEventListener("DOMContentLoaded", () => {
    let form = document.getElementById('upload_form');
    let cerrar_barra = document.getElementById('cerrar_barra');

    form.addEventListener("submit", function (e) {
        e.preventDefault();
        validarExt(form);
    });
    limpiar_barra(cerrar_barra);
    getLastProcess();
})

function limpiar_barra(close) {
    close.addEventListener("click", () => {
        file.value = "";
        barra_estado.classList.remove('barra_verde', 'barra_roja');
        barra_estado.innerHTML = "";
        barra_estado.style.width = '0%';
    });
}


function subir_archivos(form) {

    barra_estado.classList.remove('barra_verde', 'barra_roja');

    //petición

    let peticion = new XMLHttpRequest();

    //Progreso

    peticion.upload.addEventListener("progress", (e) => {
        let porcentaje = Math.round((e.loaded / e.total) * 100);
        barra_estado.style.width = porcentaje + '%';
        barra_estado.innerHTML = porcentaje + '%';
    });

    //Finalizado

    peticion.addEventListener("load", () => {
        barra_estado.classList.add('barra_verde');
        barra_estado.innerHTML = "carga completa";
    });

    //Enviar datos
    peticion.open('post', 'app/models/UploadFile.php');
    peticion.send(new FormData(form));


    //Cancelado

    btn_cancelar.addEventListener("click", function () {
        peticion.abort();
        barra_estado.classList.remove('barra_verde');
        barra_estado.classList.add('barra_roja');
        barra_estado.innerHTML = "carga imcompleta";
    })
}


function validarExt(form) {
    let archivoRuta = file.value;
    extPermitidas = /(.json)$/i;
    if (!extPermitidas.exec(archivoRuta)) {
        alert('Asegurece de haber subido un archivo .Json');
        file.value = "";
        return false;
    } else {
        if (file.files && file.files[0]) {
            subir_archivos(form);
        }
    }
}

function getLastProcess() {
    fetch('app/controllers/process/getLastProcess.php/', {
        method: 'GET',
        headers: {
            "Accept": "application/json"
        }
    })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                lastProcess.innerText = data.message;
            } else {
                alert(data.message);
            }
        });
}