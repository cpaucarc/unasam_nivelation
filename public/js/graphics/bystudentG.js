const badge_tipe = document.querySelectorAll('.badge-tipe');
const cbTipeChart = document.getElementById('tipeChart');
const cbByTipe = document.getElementById('byTipe');


const idStudent = document.getElementById('idStudent');

//default
let _tip_tipeValueeText = 'Diagrama de barras vertical';
let _tipeValue = 'bar';
let _byTipe='Dimensiones';

window.onload = () => {
    document.getElementById('view-title').innerText = 'Diagramas por estdos de estudiantes';
    badge_tipe.forEach((texto) => {
        texto.innerText = _byTipe;
    });
    Diagrams(idStudent.value,_byTipe, _tipeValue, _tip_tipeValueeText);
    alert(idStudent.value+_byTipe+ _tipeValue+ _tip_tipeValueeText);
}
cbTipeChart.addEventListener('change', () => {
    _tip_tipeValueeText = cbTipeChart.options[cbTipeChart.selectedIndex].text;
    _tipeValue = cbTipeChart.value;
    Diagrams(idStudent.value,_byTipe, _tipeValue, _tip_tipeValueeText);
});

cbByTipe.addEventListener('change', () => {
    _by_tipeValueeText = cbByTipe.options[cbByTipe.selectedIndex].text;
    _by_tipeValue = cbByTipe.value;
    _byTipe=_by_tipeValueeText;
    badge_tipe.forEach((texto) => {
        texto.innerText = _by_tipeValueeText;
    });
    Diagrams(idStudent.value,_by_tipeValueeText, _tipeValue, _tip_tipeValueeText);
});

function Diagrams(id, byTipe,tipe, title) {
    let formData = new FormData();
    formData.append('id', id);
    formData.append('byTipe', byTipe);
    fetch('http://localhost/nivelation/app/controllers/graphics/student.php', {
        method: 'POST',
        headers: {
            "Accept": "application/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            var lists = [];
            var numbers = [];
            var colors = [];
            console.log(data);
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

