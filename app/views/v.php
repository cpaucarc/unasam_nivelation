<?php
if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $name = $file['name'];
    $size = $file['size'];
    $type = $file['type'];
    $temporal = $file['tmp_name'];
    if ($type == 'application/xlsx' or $type == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' or $type == 'application/csv' or $type == 'application/xls') {
        echo "Ok " . $name . " " . $size . " " . $type . " " . $temporal;
    } else {
        echo "No es json " . $name . " " . $size . " " . $type . " " . $temporal;
    }
} else {
    echo "No hay file";
}
?>
<form id="upload_form" enctype="multipart/form-data" method="post" action="v.php/">
    <label for="file" class="mb-1">Adjunto</label>
    <input type="file" class="form-control-file" name="file" id="file"
           required>
    <button type="button" class="btn btn-light btn-sm mr-2" data-toggle="modal"
            data-target="#exampleModal" id="preview">
        <i class="bi bi-table mr-2"></i>Vista previa
    </button>
    <button type="submit" class="btn btn-primary btn-sm" id="btn_upload">
        <i class="bi bi-server mr-2"></i>Guardar y clasificar datos
    </button>
</form>


<script>
    const formula = document.getElementById('upload_form')
    const preview = document.getElementById('preview')

    // formula.onchange = (e) => {
    //     //e.preventDefault()
    //     formData = new FormData(formula)
    //
    //     fetch('app/views/paratestear.php/', {
    //         method: 'POST',
    //         headers: {
    //             "Accept": "application/json"
    //         },
    //         body: formData
    //     })
    //         .then(response => response.json())
    //         .then(data => {
    //             console.log(data)
    //         });
    // }

    preview.onclick = () => {
        console.log('Hello')
    }

</script>