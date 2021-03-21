const lastProcess = document.getElementById('lastProcess');
const uploadForm = document.getElementById('upload_form');

window.addEventListener('load', () => {
    getLastProcess();
});

uploadForm.addEventListener('submit', (e) => {
    e.preventDefault();
    let formData = new FormData(uploadForm);
    // console.log(saveFile(formData));
    saveFile(formData).then(data => {
        console.log(data);
        if (data.status === true) {
            processStudentsData(data.message);
        } else {
            alert(data.message)
        }
    });

});

function getLastProcess() {
    fetch('http://localhost/nivelation/app/controllers/process/getLastProcess.php/', {
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

const file = async function saveFile(formData) {
    return await fetch('http://localhost/nivelation/app/controllers/index/saveUploadFile.php/', {
        method: 'POST',
        body: formData
    })
        .then(response => response.text())
        .then(data => {
            console.log(data);
        });
}

async function saveFile(formData) {
    const response = await fetch('http://localhost/nivelation/app/controllers/index/saveUploadFile.php/', {
        method: 'POST',
        body: formData
    });
    return await response.json();
}

async function processStudentsData(path) {
    let formData = new FormData();
    formData.append('path', path);

    const response = await fetch('http://localhost/nivelation/app/controllers/index/processJson.php/', {
        method: 'POST',
        body: formData
    });
    const json = await response.json();
    console.log(json);
}
