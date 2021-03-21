$(document).ready(() => {
    $('.upload_file').on('submit', upload);

    //Funcion
    function upload(e) {
        e.preventDefault();
        let form = $(this),
            wrapper = $('.wrapper'),
            wrapper_f = $('.wrapper_files'),
            progress_bar = $('.progress_bar'),
            data = new FormData(form.get(0));


        //Inicializamos la barra de progreso
        progress_bar.removeClass('bg-success bg-danger').addClass('bg-info');
        progress_bar.css('width', '0%');
        progress_bar.html('Procesando ...');
        wrapper.fadeIn();


        $.ajax({
            xhr: function () {
                let xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (e) {
                    if (e.lengthComputable) {
                        let porcentComplete = Math.floor((e.loaded / e.total) * 100);
                        //Mostramos el progreso
                        progress_bar.css('width', porcentComplete + '%');
                        progress_bar.html(porcentComplete + '%');
                    }
                }, false);
                return xhr;
            },
            type: 'POST',
            url: 'app/controllers/upload.php',
            dataType: 'json',
            contentType: false,
            processData: false,
            cache: false,
            data: data,
            beforeSend: () => {
                $('button', form).attr('disabled', true);
            }
        }).done(res => {
            if (res.status === 200) {
                progress_bar.removeClass('bg-info').addClass('bg-success');
                progress_bar.html('¡Complete!');
                form.trigger('reset');//Reinicia el formulario

                //Agregamos un botón de descarga del archivo
                wrapper_f.append('<a class="d-block btn btn-light btn-sm mt-2" href="' + res.data + '" download>Descargar ' + res.data + '</a>');

                setTimeout(() => {
                    wrapper.fadeOut();
                    progress_bar.removeClass('bg-success bg-danger').addClass('bg-info');
                    progress_bar.css('width', '0%');
                }, 1500);
            } else {
                alert(res.msg);
                progress_bar.css('width', '100%');
                progress_bar.html(res.msg);
            }
        }).fail(err=>{
            progress_bar.removeClass('bg-success bg-info').addClass('bg-danger');
            progress_bar.html('¡Error en carga!');
        }).always(() => {
            $('button', form).attr('disabled', false);
        })
    }

});