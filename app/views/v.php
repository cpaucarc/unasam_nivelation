<?php

if (isset($_SESSION['user'])){
    echo 'Hay session' . $_SESSION['user'];
}else{
    header("Location: http://localhost/nivelation/login.php", TRUE, 301);
    exit();
}

include_once($_SERVER['DOCUMENT_ROOT'] . '/nivelation/dirs.php');
require_once(MODEL_PATH . "ProcessModel.php");

$p = new ProcessModel();
echo $p->getLastProcess();

?>


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
<button id="click-me">Click me</button>

<div id="div"></div>
</body>
<script>
    const btn = document.getElementById('click-me');
    const stID = 11;
    btn.addEventListener('click', () => {
        console.log('hello');

        let formData = new FormData();
        formData.append('stID', stID);

        fetch('http://localhost/nivelation/app/controllers/StudentCourses.php/', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                console.log(data)
                console.log(data.courses)

                courses = data.courses;
                var msg = '<ul>';
                courses.forEach(c => {
                    msg += `<li>${c.course} -> ${c.percent} -> ${c.stat}</li>`
                })
                msg += '</ul>';

                document.getElementById('div').innerHTML = msg;

            });
    })
</script>

</html>

