<?php

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
          integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
            integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
            integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF"
            crossorigin="anonymous"></script>
    <style>
        .piner {
            background-color: #b5bdf8;;
        }
    </style>
</head>
<body class="h-100">
<div class="text-center mh-100 piner" id="contenedor">
    <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<div id="images">
    <p class="my-4">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur atque commodi eaque incidunt iusto
        natus nisi praesentium quae sint ullam! Aliquam debitis dolorem error esse et explicabo incidunt itaque
        sunt.
    </p>
    <p class="my-4">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur atque commodi eaque incidunt iusto
        natus nisi praesentium quae sint ullam! Aliquam debitis dolorem error esse et explicabo incidunt itaque
        sunt.
    </p>
    <p class="my-4">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur atque commodi eaque incidunt iusto
        natus nisi praesentium quae sint ullam! Aliquam debitis dolorem error esse et explicabo incidunt itaque
        sunt.
    </p>
    <p class="my-4">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur atque commodi eaque incidunt iusto
        natus nisi praesentium quae sint ullam! Aliquam debitis dolorem error esse et explicabo incidunt itaque
        sunt.
    </p>

    <img src="https://ep01.epimg.net/elpais/imagenes/2019/10/30/album/1572424649_614672_1572453030_noticia_normal.jpg"
         alt="Imagen">


    <img src="https://cdn.mos.cms.futurecdn.net/GQzS29Y2YrtMbsjCKF5JqB.jpg"
         alt="MAcOS">

    <img src="https://cdn.mos.cms.futurecdn.net/GQzS29Y2YrtMbsjCKF5JqB.jpg"
         alt="MAcOS">

    <img src="https://cdn.mos.cms.futurecdn.net/GQzS29Y2YrtMbsjCKF5JqB.jpg"
         alt="MAcOS">

    <img src="https://cdn.mos.cms.futurecdn.net/GQzS29Y2YrtMbsjCKF5JqB.jpg"
         alt="MAcOS">

    <img src="https://cdn.mos.cms.futurecdn.net/GQzS29Y2YrtMbsjCKF5JqB.jpg"
         alt="MAcOS">

    <img src="https://cdn.mos.cms.futurecdn.net/GQzS29Y2YrtMbsjCKF5JqB.jpg"
         alt="MAcOS">
    <img src="https://cdn.mos.cms.futurecdn.net/GQzS29Y2YrtMbsjCKF5JqB.jpg"
         alt="MAcOS">

    <img src="https://cdn.mos.cms.futurecdn.net/GQzS29Y2YrtMbsjCKF5JqB.jpg"
         alt="MAcOS">

    <img src="https://cdn.mos.cms.futurecdn.net/GQzS29Y2YrtMbsjCKF5JqB.jpg"
         alt="MAcOS">

    <img src="https://cdn.mos.cms.futurecdn.net/GQzS29Y2YrtMbsjCKF5JqB.jpg"
         alt="MAcOS">

    <img src="https://cdn.mos.cms.futurecdn.net/GQzS29Y2YrtMbsjCKF5JqB.jpg"
         alt="MAcOS">

    <img src="https://cdn.mos.cms.futurecdn.net/GQzS29Y2YrtMbsjCKF5JqB.jpg"
         alt="MAcOS">

</div>

<script>
    imag = document.getElementById('images')

    imag.onload = () => {
        const contenedor = document.getElementById('contenedor')
        contenedor.classList.add('d-none')
    }

</script>

</body>
</html>
