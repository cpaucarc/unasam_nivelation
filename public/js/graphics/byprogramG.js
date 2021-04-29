let process = document.getElementById('process');
const cbTipeChart = document.getElementById('tipeChart');

window.onload = () => {
    Diagrams('bar','Diagrama de barras vertical');
    document.getElementById('view-title').innerText = 'Diagramas por programas académicos';
}


cbTipeChart.addEventListener('change', () => {
    let _tip_tipeValueeText = cbTipeChart.options[cbTipeChart.selectedIndex].text;
    let _tipeValue = cbTipeChart.value;
    if (_tipeValue !='') {
        Diagrams(_tipeValue, _tip_tipeValueeText);
    }
});

function Diagrams(tipe, title) {
    let formData = new FormData();
    formData.append('process', process.value);
    fetch('http://localhost/nivelation/app/controllers/graphics/school.php', {
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
    var ctx = document.getElementById($id);
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