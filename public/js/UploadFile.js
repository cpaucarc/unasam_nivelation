document.addEventListener("DOMContentLoaded", () => {
    let form = document.getElementById('upload_form');
    let cerrar_barra = document.getElementById('cerrar_barra');
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        subir_archivos(form);
    });
    cerrar_barra.addEventListener("click", () => {
        document.querySelector('#barra').classList.remove('barra_verde', 'barra_roja');
        document.querySelector('#barra_estado').innerHTML = ""; 
        document.querySelector('#barra_estado').style.color = "#247cc0";
        document.querySelector('#file').value = "";
    });
})
function subir_archivos(form) {
    let barra_estado = document.querySelector('#barra'),
        span = document.querySelector('#barra_estado');
    let btn_cancelar = document.querySelector('#btn_cancelar');

    barra_estado.classList.remove('barra_verde', 'barra_roja');

    //petición

    let peticion = new XMLHttpRequest();

    //Progreso

    peticion.upload.addEventListener("progress", (e) => {
        let porcentaje = Math.round((e.loaded / e.total) * 100);
        console.log(porcentaje);
        barra_estado.style.width = porcentaje + '%';
        span.innerHTML = porcentaje + '%';
        span.style.color="#247cc0";
    });

    //Finalizado

    peticion.addEventListener("load", () => {
        barra_estado.classList.add('barra_verde');
        span.style.color="white";
        span.innerHTML = "Proceso Completado"
    });

    //Enviar datos
    peticion.open('post', 'app/models/UploadFile.php');
    peticion.send(new FormData(form));


    //Cancelado

    btn_cancelar.addEventListener("click", function () {
        peticion.abort();
        barra_estado.classList.remove('barra_verde');
        barra_estado.classList.add('barra_roja');
        span.style.color="white";
        span.innerHTML = "Proceso Cancelado";
    })
}