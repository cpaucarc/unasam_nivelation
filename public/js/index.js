const lastProcess = document.getElementById('lastProcess');
const uploadForm = document.getElementById('upload_form');
const fileIcon = document.getElementById('file-icon');
const coursesIcon = document.getElementById('courses-icon');
const btnPreview = document.getElementById('preview');
const btnUpload = document.getElementById('btn_upload');
const inputFile = document.getElementById('file');
const tbody = document.getElementById('tbody');
const missingCourses = document.getElementById('missing-courses');

let tbody_data = '';
let coursesOK = false;
let fileOK = false;

window.addEventListener('load', () => {
    getLastProcess();
    document.getElementById('view-title').innerText = 'Inicio del Sitio';
    getMissingCourses();
});

uploadForm.onsubmit = (e) => {
    e.preventDefault();
    alertWaitSaving();
    fetch('app/controllers/index/saveStudentsToDB.php/', {
        method: 'GET'
    })
        .then(response => response.text())
        .then(data => {
            console.log(data);
            AlertConfirm('La información se guardó correctamente', 'success', '¡Ya está!', 'primary');
        });
}

uploadForm.addEventListener('change', (e) => {
    e.preventDefault();
    alertWaitUploading();
    setIconToFile();
    tbody_data = '';
    let formData = new FormData(uploadForm);
    saveFile(formData).then(data => {
        if (data.status === true) {
            AlertConfirm('Tu archivo se subió correctamente', 'success', '¡Ya está!', 'primary');
            // Mostrar un msg: Espere mientras los datos se procesan
            //processStudentsData(data.message);
            //message: Los datos ya se guardaron
        } else {
            /* alert(data.message) */
            AlertConfirm(data.message, 'error', '¡Error!', 'danger');
        }
        fileOK = data.status;
        toggleBtnPreview(data.status);
        toggleBtnUpload();
    });

});

btnPreview.onclick = () => {
    if (tbody_data === '') {
        getDataForTable();
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
                AlertConfirm(data.message, 'error', '¡Error!', 'danger');
            }
        });
}

function getDataForTable() {
    fetch('app/controllers/index/getDataForTable.php/', {
        method: 'GET'
    })
        .then(response => response.text())
        .then(data => {
            tbody_data = data;
            tbody.innerHTML = data;
        });
}

function getMissingCourses() {
    fetch('app/controllers/area/getMissingCourses.php/', {
        method: 'GET'
    })
        .then(response => response.json())
        .then(data => {
            missingCourses.innerHTML = data.message;
            coursesOK = data.status;
            if (coursesOK) {
                coursesIcon.innerHTML = '<i class="bi bi-emoji-frown text-danger mr-2"></i>Ver pasos faltantes';
            } else {
                coursesIcon.innerHTML = '<i class="bi bi-emoji-smile text-success mr-2"></i>Completo';
            }
        });
}

async function saveFile(formData) {
    const response = await fetch('app/controllers/index/saveUploadFile.php/', {
        method: 'POST',
        body: formData
    });
    return await response.json();
}

async function processStudentsData(path) {
    let formData = new FormData();
    formData.append('path', path);
    await console.log(path);

    const response = await fetch('app/controllers/index/processJson.php/', {
        method: 'POST',
        body: formData
    });
    const json = await response.json();
    await console.log(json);
}

function getFileIcon(extension) {
    let icon;
    if (extension === "xls" || extension === "xlsx" || extension === "csv") {
        icon = '<i class="bi bi-file-earmark-excel text-success"></i>';
    } else if (extension === "ppt" || extension === "pptx") {
        icon = '<i class="bi bi-file-earmark-ppt"></i>';
    } else if (extension === "doc" || extension === "docx") {
        icon = '<i class="bi bi-file-earmark-word"></i>';
    } else if (extension === "pdf") {
        icon = '<i class="bi bi-file-earmark"></i>';
    } else if (extension === "png" || extension === "jpg" || extension === "jpeg" || extension === "svg") {
        icon = '<i class="bi bi-file-earmark-image"></i>';
    } else if (extension === "rar" || extension === "zip" || extension === "tar") {
        icon = '<i class="bi bi-file-earmark-zip"></i>';
    } else {
        icon = '<i class="bi bi-question-square"></i>';
    }

    return icon;
}

function setIconToFile() {
    let filename = inputFile.value;
    if (filename !== '') {
        let ext = filename.split('.').pop();
        fileIcon.innerHTML = getFileIcon(ext)
    }
}

function toggleBtnPreview(response) {
    btnPreview.disabled = !response;
}

function toggleBtnUpload() {
    btnUpload.disabled = !(!coursesOK && fileOK);
}


//SweetAlert2
function AlertConfirm(message, tipe, title, variable) {
    if (message !== '') {
        Swal.fire({
            icon: tipe,
            position: 'center',
            html: `<strong>${title}</strong></br><small>${message}</small>`,
            showCloseButton: true,
            confirmButtonColor: 'var(--' + variable + ')'
        })
    }
}

function AlertWait(image, title, message) {
    Swal.fire({
        position: 'center',
        imageUrl: image,
        imageWidth: 100,
        imageHeight: 100,
        html: `<strong>${title}</strong></br><small>${message}</small>`,
        showConfirmButton: false,
        backdrop: false
    })
}

function alertWaitUploading() {
    let img = 'https://media1.giphy.com/media/aQ6qeqSuo0xxSQPV87/giphy.gif?cid=790b7611fc1c5a0ba5ef139d2994981c8192929e5ecc8635&rid=giphy.gif&ct=g';
    AlertWait(img, 'Espere mientras se sube el archivo.', 'El tiempo puede variar por tu conexión a internet y el número de datos.');
}

function alertWaitSaving() {
    let img = 'https://media1.giphy.com/media/aQ6qeqSuo0xxSQPV87/giphy.gif?cid=790b7611fc1c5a0ba5ef139d2994981c8192929e5ecc8635&rid=giphy.gif&ct=g';
    AlertWait(img, 'Espere mientras se guarda la información.', 'El tiempo puede variar por tu conexión a internet y el número de datos.');
}