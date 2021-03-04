const cbSemester = document.getElementById('semestre');

cbSemester.addEventListener('change', () => {
    let selectedSemeter = cbSemester.value;
    console.log(selectedSemeter);
    getAllRanksByProcessID(selectedSemeter);
});

function getAllRanksByProcessID(process) {
    let formData = new FormData();
    formData.append('process', process);
    fetch('http://localhost/nivelation/app/controllers/ranks/getAllRanksByProcess.php/', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            data = data.ranks;
            console.log(data);
            const areaA = data.filter(rank => rank.area === 'A');
            const areaB = data.filter(rank => rank.area === 'B');
            const areaC = data.filter(rank => rank.area === 'C');
            const areaD = data.filter(rank => rank.area === 'D');
            fillWhitAreaA(areaA);
            fillWhitAreaB(areaB);
            fillWhitAreaC(areaC);
            fillWhitAreaD(areaD);
        });
}

function fillWhitAreaA(area) {
    //area es un JSON
    if (area.length > 0) {
        //crear las cards para el area A
        console.log(area);
    }
}

function fillWhitAreaB(area) {
    //area es un JSON
    if (area.length > 0) {
        //crear las cards para el area B
        console.log(area);
    }
}

function fillWhitAreaC(area) {
    //area es un JSON
    if (area.length > 0) {
        //crear las cards para el area C
        console.log(area);
    }
}

function fillWhitAreaD(area) {
    //area es un JSON
    if (area.length > 0) {
        //crear las cards para el area D
        console.log(area);
    }
}
