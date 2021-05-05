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
    alert('Esta funcion se implementará mas adelante')
}

uploadForm.addEventListener('change', (e) => {
    e.preventDefault();
    /* alert('Espere mientras se guarda el archivo'); */
    AlertWait('Espere mientras se guarda el archivo','success');
    setIconToFile();
    tbody_data = '';
    let formData = new FormData(uploadForm);
    saveFile(formData).then(data => {
        if (data.status === true) {
            /* alert('Archivo subido'); */
            AlertConfirm('Archivo subido', 'success', '¡Éxito!', 'primary');
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

function AlertWait(message,tipe) {
    Swal.fire({
        icon:tipe,
        title: message,
        backdrop: `
          rgba(0,0,0,0.4)
          url("https://i.pinimg.com/originals/50/d6/0b/50d60b0dccd86bfb597502eac92e3923.gif")
          200px bottom
          no-repeat
        `,
        showCloseButton: true,
        confirmButtonColor: 'var(--primary)'
    })
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