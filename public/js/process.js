const form = document.getElementById('form');
let tbody = document.getElementById('tbody');
let newProcess = document.getElementById('new-process');

button = new Button();
table = new Table();
sweet = new SweetAlerts();

window.onload = () => {
    getAllProcess();
    getLastProcess();
    document.getElementById('view-title').innerText = 'Procesos de Admisión';
}

form.addEventListener('submit', (e) => {
    e.preventDefault();
    let formData = new FormData(form);

    fetch('app/controllers/process/saveProcess.php/', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === true) {
                sweet.successAlert('¡Éxito!', data.message);
                getAllProcess();
                $('#process_modal').modal('hide');
                getLastProcess();
            } else {
                sweet.errorAlert('¡Error!', data.message);
            }
        });
});

newProcess.addEventListener('click', () => {
    form.reset();
    $('#process_modal').modal('show');
})

function getAllProcess() {
    fetch('app/controllers/process/getAllProcess.php/', {
        method: 'GET',
        headers: {
            "Accept": "application/json"
        }
    })
        .then(response => response.json())
        .then(data => {
            data = data.process;
            fillTable(data);
        });
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

function fillTable(process) {
    tbody.innerHTML = '';
    $('#table-process').DataTable().clear().destroy();
    process.forEach((p, i) => {
        let row = table.createRow((i + 1), p.name, `${p.percent}% = (${p.percent * 4} puntos)`, p.qualification);
        let btnEdit = button.createBtnEdit(updateProcess, p);
        row.appendChild(table.createCell(btnEdit));
        tbody.appendChild(row);
    });
    $('#table-process').DataTable();
}

function updateProcess(proc) {
    document.getElementById('procID').value = proc.id;
    document.getElementById('denomination').value = proc.name;
    document.getElementById('minPercent').value = proc.percent;
    document.getElementById('minQlf').value = proc.qualification;
    $('#process_modal').modal('show');
}

function deleteProcess(id) {
    alert(`Delete ${id}`);
}