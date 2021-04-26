let process = document.getElementById('process');
window.onload = () => {
    Diagrams();
    document.getElementById('view-title').innerText = 'Diagramas por coursos';
}

function Diagrams() {
    let formData = new FormData();
    formData.append('process', process.value);
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
            chart('chartBar', 'bar', colors, lists, numbers, 'Diagrama de barras vertical');
            chart('chartDoughnut', 'doughnut', colors, lists, numbers, 'Diagrama doughnut');
            chart('chartHorizontalBar', 'horizontalBar', colors, lists, numbers, 'Diagrama de barras horizontal'); 
            /* chart('chartPie', 'pie', colors, lists, numbers, 'Diagrama de barras'); */
            chart('chartPie', 'pie', colors, lists, numbers, 'Diagrama de pastel');
        });

}


function chart($id, $tipo, $colores, $lista, $datos, $titulo) {

    var ctx = document.getElementById($id);
    var myChart = new Chart(ctx, {
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