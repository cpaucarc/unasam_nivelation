const cbProcess = document.getElementById('process');
const badge_process = document.querySelectorAll('.badge-process');
select = new Select();
window.onload = () => {
    fillWhitProcess();
    document.getElementById('view-title').innerText = 'Diagramas por general';
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
            Diagrams(data[0].name);
            //agregado automatico del procesos final
            cbProcess.innerHTML = ``;
            cbProcess.appendChild(select.createOption(0, 'Selecciona...'));
            data.forEach(proc => {
                cbProcess.appendChild(select.createOption(proc.id, proc.name));
            });
        });
}


cbProcess.addEventListener('change', () => {
    let _processText = cbProcess.options[cbProcess.selectedIndex].text;
    let _processValue = parseInt(cbProcess.value);

    if (_processValue > 0) {
        badge_process.forEach((texto) => {
            texto.innerText = _processText;
        });
        Diagrams(_processText);
    }
});

function Diagrams(process) {
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
            chart('chartBar', 'bar', colors, lists, numbers, 'Diagrama de barras vertical');
            chart('chartDoughnut', 'doughnut', colors, lists, numbers, 'Diagrama doughnut');
            chart('chartHorizontalBar', 'horizontalBar', colors, lists, numbers, 'Diagrama de barras horizontal');
            /* chart('chartPie', 'pie', colors, lists, numbers, 'Diagrama de barras'); */
            chart('chartPie', 'pie', colors, lists, numbers, 'Diagrama de pastel');
            chartArea('myAreaChart', 'line', colors, lists, numbers, 'Diagrama de lineal');
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

/*==============================Grafico con area ==============================*/
// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function number_format(number, decimals, dec_point, thousands_sep) {
    // *     example: number_format(1234.56, 2, ',', ' ');
    // *     return: '1 234,56'
    number = (number + '').replace(',', '').replace(' ', '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}

// Area Chart Example

function chartArea($id, $tipo, $colores, $lista, $datos, $titulo) {
    var ctx = document.getElementById($id);
    var myLineChart = new Chart(ctx, {
        type: $tipo,
        data: {
            labels: $lista,
            datasets: [{
                label: $titulo,
                lineTension: 0.3,
                backgroundColor: $colores,
                borderColor: $colores,
                pointRadius: 3,
                pointBackgroundColor: $colores,
                pointBorderColor: $colores,
                pointHoverRadius: 3,
                pointHoverBackgroundColor: $colores,
                pointHoverBorderColor: $colores,
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: $datos,
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    time: {
                        unit: 'date'
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 7
                    }
                }],
                yAxes: [{
                    ticks: {
                        maxTicksLimit: 5,
                        padding: 10,
                        // Include a dollar sign in the ticks
                        callback: function (value, index, values) {
                            /*  return '$' + number_format(value); */
                            return number_format(value);
                        }
                    },
                    gridLines: {
                        color: $colores,
                        zeroLineColor: $colores,
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }],
            },
            legend: {
                display: false
            },
            tooltips: {
                backgroundColor: $colores,
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10,
                callbacks: {
                    label: function (tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
                    }
                }
            }
        }
    });
}