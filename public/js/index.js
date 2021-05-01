const lastProcess = document.getElementById('lastProcess');
const uploadForm = document.getElementById('upload_form');
const fileIcon = document.getElementById('file-icon');
const btnPreview = document.getElementById('preview');
const btnUpload = document.getElementById('btn_upload');
const inputFile = document.getElementById('file');
const tbody = document.getElementById('tbody');

const ruta = document.getElementById('ruta');
var tbody_data = '';

window.addEventListener('load', () => {
    getLastProcess();
    document.getElementById('view-title').innerText = 'Inicio del Sitio';
});

uploadForm.addEventListener('change', (e) => {
    e.preventDefault();
    setIconToFile();
    tbody_data = '';
    let formData = new FormData(uploadForm);
    saveFile(formData).then(data => {
        console.log(data);
        if (data.status === true) {
            alert('Espere mientras se guarda el archivo');
            // Mostrar un msg: Espere mientras los datos se procesan

            //processStudentsData(data.message);

            //message: Los datos ya se guardaron
        } else {
            alert(data.message)
        }
        toggleBtnPreview(data.status);
        toggleBtnUpload(data.status);
    });

});

btnPreview.onclick = () => {
    if (tbody_data === '') {
        getTableFromExcel();
    } else {
        tbody.innerHTML = tbody_data;
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

ruta.onclick = () => {
    getPath();
}

function getPath() {
    fetch('app/views/paratestear.php/', {
        method: 'GET'
    })
        .then(response => response.text())
        .then(data => {
            console.log(data)
            typeof data;
        });
}

function getTableFromExcel() {
    fetch('app/controllers/index/getTableFromExcel.php/', {
        method: 'GET'
    })
        .then(response => response.text())
        .then(data => {
            console.log(data);
            tbody_data = data;
            tbody.innerHTML = data;
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
    let icon = '';
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

function toggleBtnUpload(response) {
    btnUpload.disabled = !response;
}