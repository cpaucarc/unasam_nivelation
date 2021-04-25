const form = document.getElementById('form');
let tbody = document.getElementById('tbody');
let newProcess = document.getElementById('new-process');
button = new Button();
table = new Table();

window.onload = () => {
    getAllProcess();
    getLastProcess();
    document.getElementById('view-title').innerText = 'Procesos de Admisión';
}

form.addEventListener('submit', (e) => {
    e.preventDefault();
    //Save and Edit process
    let formData = new FormData(form);

    fetch('app/controllers/process/saveProcess.php/', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data.status === true) {
                getAllProcess();
                alert(data.message);
                $('#process_modal').modal('hide');
                getLastProcess();
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
                alert(data.message);
            }
        });
}

function fillTable(process) {
    tbody.innerHTML = '';
    $('#table-process').DataTable().clear().destroy();
    let num = 1;
    process.forEach(p => {
        let row = table.createRow(num, p.name);
        let btnEdit = button.createBtnEdit(updateProcess, p.id, p.name);
        row.appendChild(table.createCell(btnEdit));
        tbody.appendChild(row);
        num++;
    });
    $('#table-process').DataTable();
}

function updateProcess(id, proc) {
    document.getElementById('procID').value = id;
    document.getElementById('denomination').value = proc;
    $('#process_modal').modal('show');
}

function deleteProcess(id) {
    alert(`Delete ${id}`);
}

function createGroupButton() {
    let group = document.createElement('div');
    group.classList.add('btn-group');
    return group;
}