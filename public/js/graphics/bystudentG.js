const cbProcess = document.getElementById('process');
const badge_process = document.querySelectorAll('.badge-process');
const cbTipeChart = document.getElementById('tipeChart');
//default
let _tip_tipeValueeText = 'Diagrama de barras vertical';
let _tipeValue = 'bar';
let _process;

select = new Select();

window.onload = () => {
    fillWhitProcess();
    document.getElementById('view-title').innerText = 'Diagramas por estdos de estudiantes';
}
cbTipeChart.addEventListener('change', () => {
    _tip_tipeValueeText = cbTipeChart.options[cbTipeChart.selectedIndex].text;
    _tipeValue = cbTipeChart.value;
    // alert(_process + _tipeValue + _tip_tipeValueeText);
    if (_tipeValue !== '') {
        Diagrams(_process, _tipeValue, _tip_tipeValueeText);
    }
});

cbProcess.addEventListener('change', () => {
    let _processValue = 0;
    _process = cbProcess.options[cbProcess.selectedIndex].text;
    _processValue = parseInt(cbProcess.value);
    if (_processValue > 0) {

        Diagrams(_process, _tipeValue, _tip_tipeValueeText);
        badge_process.forEach((texto) => {
            texto.innerText = _process;
        });
    }
});

function Diagrams(process, tipe, title) {
    let formData = new FormData();
    formData.append('process', process);
    fetch('http://localhost/nivelation/app/controllers/graphics/student.php', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            var lists = [];
            var numbers = [];
            var colors = [];
            for (var i = 0; i < data.length; i++) {
                lists.push(data[i][0]);
                numbers.push(data[i][1]);
                colors.push(colorRGB());
            }
            chart('chart', tipe, colors, lists, numbers, title);
        });
}


function chart($id, $tipo, $colores, $lista, $datos, $titulo) {
    if (window.myChart) {
        window.myChart.destroy();
    }
    const ctx = document.getElementById($id);
    window.myChart = new Chart(ctx, {
        type: $tipo,
        data: {
            labels: $lista,
            datasets: [{
                label: $titulo,
                data: $datos,
                backgroundColor: $colores,
                borderColor: $colores,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                },
                x: {
                    min: 0
                }
            }
        }
    });

}

function generarNumero(numero) {
    return (Math.random() * numero).toFixed(0);
}

function colorRGB() {
    var coolor = "(" + generarNumero(255) + "," + generarNumero(255) + "," + generarNumero(255) + ")";
    return "rgb" + coolor;
}


function fillWhitProcess() {
    fetch('app/controllers/process/getAllProcess.php/', {
        method: 'GET',
        headers: {
            "Accept": "application/json"
        }
    })
        .then(response => response.json())
        .then(data => {
            data = data.process;
            //agregado automatico del procesos final
            badge_process.forEach((texto) => {
                texto.innerText = data[0].name;
            });

            //agregado automatico del procesos final
            cbProcess.innerHTML = ``;
            cbProcess.appendChild(select.createOption(0, 'Selecciona...'));
            data.forEach(proc => {
                if (proc.id === 1) {
                    //Capturar proceso name final
                    Diagrams(proc.name, _tipeValue, _tip_tipeValueeText);
                    _process = proc.name;
                }
                cbProcess.appendChild(select.createOption(proc.id, proc.name));
            });
        });
}