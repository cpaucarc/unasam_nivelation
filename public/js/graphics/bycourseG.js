const process = document.getElementById('process');
const cbStatus = document.getElementById('status');
window.onload = () => {
    Diagrams(3, process.value, 'horizontalBar');
    document.getElementById('view-title').innerText = 'Reporte por curso';
}
cbStatus.addEventListener('change', () => {
    let _statusValue = 0;
    let tipo = 'horizontalBar';
    _statusValue = parseInt(cbStatus.value);
    if (_statusValue == 1) {
        /* tipo = 'bar'; */
        tipo = 'horizontalBar';
    } else if (_statusValue == 2) {
        /* tipo = 'doughnut'; */
        tipo = 'horizontalBar';
    } else {
        tipo = 'horizontalBar';
    }
    if (_statusValue > 0) {
        Diagrams(_statusValue, process.value, tipo);
    }
});

function Diagrams(status, procss, tipe) {
    let formData = new FormData();
    formData.append('process', procss);
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


            chart('chart', tipe, colors, lists, numbers, 'Diagrama de '+tipe);
            /* chart('chartPie', 'pie', colors, lists, numbers, 'Diagrama de pastel');
 */
            /*   chart('chartDoughnut', 'doughnut', colors, lists, numbers, 'Diagrama doughnut');
              chart('chartHorizontalBar', 'horizontalBar', colors, lists, numbers, 'Diagrama de barras horizontal'); */

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