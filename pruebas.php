<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<label for="range">Rango: </label><input type="range" name="asdfr" id="range" min="0" max="100">

<p id="asd">

</p>


<script>

    window.onload = () => {
        asd = document.getElementById('asd');
        range = document.getElementById('range');

        fetch(`app/views/v.php/`, {
            method: 'POST',
            headers: {
                "Accept": "application/text"
            }
        })
            .then(response => response.text())
            .then(data => {
                data = data.split('-')

                data.forEach(prc => {
                    console.log(prc)
                    range.value = parseFloat(prc);
                    asd.innerHTML = prc;
                })
                // asd.innerHTML = data;
            });
    }

</script>

</body>
</html>
