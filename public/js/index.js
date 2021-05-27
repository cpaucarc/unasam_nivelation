const lastProcess = document.getElementById('lastProcess');
const uploadForm = document.getElementById('upload_form');
const fileIcon = document.getElementById('file-icon');
const coursesIcon = document.getElementById('courses-icon');
const btnPreview = document.getElementById('preview');
const btnUpload = document.getElementById('btn_upload');
const inputFile = document.getElementById('file');
const tbody = document.getElementById('tbody');
const missingCourses = document.getElementById('missing-courses');

sweet = new SweetAlerts();
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
    sweet.waitAlert('Espere mientras se guarda la información.', 'El tiempo puede variar por tu conexión a internet y el número de datos.');
    fetch('app/controllers/index/saveStudentsToDB.php/', {
        method: 'GET'
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data.status !== 0) {
                if (parseInt(data.response[0]['failed']) > 0) {
                    let table = `<table class="table border table-sm text-left">
                        <thead class="thead-light">
                        <tr><th><small><strong>Número</strong></small></th>
                            <th><small><strong>Código</strong></small></th>
                            <th><small><strong>Estudiante</strong></small></th>
                            <th><small><strong>Donde falló</strong></small></th>
                        </tr>
                        </thead><tbody>`;
                    let students = data.response[0]['students'];
                    students.forEach(std => {
                        table += `<tr>
                            <td><small>${std.num}</small></td>
                            <td><small>${std.code}</small></td>
                            <td><small>${std.name}</small></td>
                            <td><small>${std.message}</small></td>
                            </tr>`;
                    });
                    table += '</tbody></table>';
                    sweet.warningAlertWithTable(data, table);
                } else {
                    sweet.successAlertWithoutTable(data);
                }
            } else {
                sweet.errorAlert('¡Error!', data.message);
            }
        });
}

uploadForm.addEventListener('change', (e) => {
    e.preventDefault();
    sweet.waitAlert('Espere mientras se sube el archivo.', 'El tiempo puede variar por tu conexión a internet y el número de datos.');
    setIconToFile();
    tbody_data = '';
    let formData = new FormData(uploadForm);
    saveFile(formData).then(data => {
        if (data.status === true) {
            sweet.successAlert('¡Ya está!', 'Tu archivo se subió correctamente');
        } else {
            sweet.errorAlert('¡Error!', data.message)
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
                sweet.errorAlert('¡Error!', data.message);
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
    const response = await fetch('app/controllers/index/processJson.php/', {
        method: 'POST',
        body: formData
    });
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