const tbody = document.getElementById('tbody');
const weightFiles = document.getElementById('weight-files');
const countFiles = document.getElementById('count-files');
const deleteAll = document.getElementById('delete-all');

window.addEventListener('load', () => {

    document.getElementById('view-title').innerText = 'Archivos';

    table = new Table();
    buttons = new Button();

    getAllFiles();
    getGeneralInfo();
});

deleteAll.onclick = () => {
    deleteAllFiles();
}

function getAllFiles() {
    fetch('app/controllers/files/getAllFiles.php/', {
        method: 'GET',
        headers: {
            "Accept": "application/json"
        }
    })
        .then(response => response.json())
        .then(data => {
            data = data.files;
            tbody.innerHTML = '';
            let num = 1;
            data.forEach(file => {
                let btnDelete = buttons.createBtnDelete(deleteFile, file.name);
                let btnDown = buttons.createBtnDownload(downloadFile, file.name);
                let column = table.createColumn();
                column.appendChild(buttons.createGroupButton(btnDown, btnDelete));
                let row = table.createRow(num, file.name, file.size, file.time);
                row.appendChild(column);
                tbody.appendChild(row);
                num++;
            })
        });
}

function getGeneralInfo() {
    fetch('app/controllers/files/getGeneralInfo.php/', {
        method: 'GET',
        headers: {
            "Accept": "application/json"
        }
    })
        .then(response => response.json())
        .then(data => {
            weightFiles.innerHTML = data.size;
            countFiles.innerHTML = data.count;
        });
}

function getIconForFile(type) {
    if (type === 'file') {
        return '<i class="bi bi-file-earmark-excel"></i>';
    } else {
        return '<i class="bi bi-folder"></i>'
    }
}

function deleteFile(name) {
    Swal.fire({
        icon: 'question',
        html: `¿Quieres eliminar el archivo <strong>${name}</strong>?`,
        showCancelButton: true,
        confirmButtonText: `<i class="bi bi-trash"></i> Eliminar archivo`,
        confirmButtonColor: 'var(--danger)',
    }).then((result) => {
        if (result.isConfirmed) {
            let formData = new FormData();
            formData.append('name', name);
            fetch('app/controllers/files/deleteFile.php/', {
                method: 'POST',
                headers: {
                    "Accept": "application/json"
                },
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data.message);
                    getAllFiles();
                    getGeneralInfo();
                });
        }
    })
}

function deleteAllFiles() {
    Swal.fire({
        icon: 'question',
        html: `¿Quieres eliminar todos los archivos?`,
        showCancelButton: true,
        confirmButtonText: `<i class="bi bi-trash"></i> Eliminar todos los archivos`,
        confirmButtonColor: 'var(--danger)',
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('app/controllers/files/deleteAllFiles.php/', {
                method: 'GET'
            })
                .then(response => response.text())
                .then(data => {
                    console.log(data);
                    getAllFiles();
                    getGeneralInfo();
                });
        }
    })
}

function downloadFile(name) {
    let url = `app/files/${name}`;
    window.open(url);
}