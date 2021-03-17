<?php
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
          integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Document</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

</head>
<body>

<h1>Hello</h1>

<h2>Subtitle</h2>

<select name="cbSemester" id="cbSemester">
    <option value="2020-I">2020-I</option>
    <option value="2020-II">2020-II</option>
    <option value="2019-I">2019-I</option>
</select>

<div class="container">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Card title</h5>

            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                </tr>
                </tbody>
            </table>

            <div id="la-tabla" class="mt-2"></div>
            <div id="div" class="mt-2"></div>

        </div>
    </div>
</div>


<!--<script src="../../public/js/ranks.js"></script>-->
<script src="../../public/js/components/Table.js"></script>
<script src="../../public/js/components/Button.js"></script>

<script>
    table = new Table();
    button = new Button();

    tb = document.getElementById('la-tabla');
    div = document.getElementById('div');

    tb.appendChild(table.createLightTable('body', '#', 'First', 'Last', 'Handle'));
    //.innerHTML = table.getTable('body', 'num', 'chy', 'chu', 'chu', 'no');

    tbd = document.getElementById('body');

    tbd.appendChild(table.createRow('1', 'Larry', 'The Bird', '@twitetr'));
    tbd.appendChild(table.createRow('1', 'Jacob', 'Thornton', '@@fat'));

    div.appendChild(button.createBtnPrimary('hello', null, null))
    div.appendChild(button.createBtnEdit(saludar, 1))

    function saludar() {
        alert('Hello ' + name);
    }

</script>

</body>

</html>