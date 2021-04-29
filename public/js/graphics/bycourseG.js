const process = document.getElementById('process');
const cbStatus = document.getElementById('status');
const cbTipeChart = document.getElementById('tipeChart');
//default
let _tip_tipeValueeText='Diagrama de barras vertical' ;
let _tipeValue='bar';
let _statusValue = 3;

window.onload = () => {
    Diagrams(_statusValue, _tipeValue, _tip_tipeValueeText);
    document.getElementById('view-title').innerText = 'Diagramas por cursos especificos';
}

cbTipeChart.addEventListener('change', () => {
    _tip_tipeValueeText = cbTipeChart.options[cbTipeChart.selectedIndex].text;
    _tipeValue = cbTipeChart.value;
    if (_tipeValue != '') {
        Diagrams(_statusValue, _tipeValue, _tip_tipeValueeText);
    }
});

cbStatus.addEventListener('change', () => {
    _statusValue = parseInt(cbStatus.value);
    if (_statusValue > 0) {
        Diagrams(_statusValue, _tipeValue, _tip_tipeValueeText);
    }
});

function Diagrams(status, tipe, title) {
    let formData = new FormData();
    formData.append('process', process.value);
    formData.append('status', status);
    fetch('app/controllers/graphics/course.php', {
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
    if (window.myChart && window.myChart !== null) { window.myChart.destroy(); }
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
                    beginAtZero: false
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