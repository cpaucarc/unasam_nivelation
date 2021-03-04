const form = document.getElementById('form');

form.addEventListener('submit', (e) => {
    e.preventDefault();

    let data = new FormData(form);

    fetch('http://localhost/nivelation/app/controllers/process/saveProcess.php/', {
        method: 'POST',
        body: data
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            getAllProcess();
        });

    //console.log(data.get('process-denomination'));

});

document.getElementById('btn').addEventListener('click', () => {
    getAllProcess();
})

function getAllProcess() {
    fetch('http://localhost/nivelation/app/controllers/process/getAllProcess.php/', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        }
    })
        .then(response => response.json())
        .then(data => {
            data = data.process;
            fillTable(data)
        });
}

function fillTable(process) {
    let tbody = document.getElementById('table-body');
    tbody.innerHTML = '';
    process.forEach(p => {
        let row = document.createElement('tr');
        createAndAppendSimpleColumn(p.id, row);
        createAndAppendSimpleColumn(p.denomination, row);
        createAndAppendButtonColumn('update', row, updateProcess, p.id);
        createAndAppendButtonColumn('delete', row, deleteProcess, p.id);
        tbody.appendChild(row);
    })
}

function createAndAppendSimpleColumn(text, parent) {
    let column = document.createElement('td');
    column.innerText = text;
    parent.appendChild(column);
}

function createAndAppendButtonColumn(text, parent, fun, id) {
    let column = document.createElement('td');
    let button = document.createElement('button');
    button.innerText = text;
    button.addEventListener("click", function () {
        fun(id);
    }, false);
    column.appendChild(button);
    parent.appendChild(column);
}

function updateProcess(id) {
    alert(`Update ${id}`);
}

function deleteProcess(id) {
    alert(`Delete ${id}`);
}