class SweetAlerts {

    constructor() {
    }

    baseAlert(icon = 'success', title, message) {
        Swal.fire({
            icon: icon,
            title: title,
            text: message,
            showCloseButton: false,
            confirmButtonColor: 'var(--primary)'
        })
    }

    waitAlert(title = '', message = '') {
        this.image = 'public/images/loading-unasam.gif';
        this.width = 150;
        this.height = 150;
        Swal.fire({
            position: 'center',
            imageUrl: this.image,
            imageWidth: this.width,
            imageHeight: this.height,
            html: `<strong>${title}</strong></br><small>${message}</small>`,
            showConfirmButton: false,
            backdrop: false
        })
    }

    successAlert(title = '', message = '') {
        this.baseAlert('success', title, message);
    }

    errorAlert(title = '', message = '') {
        this.baseAlert('error', title, message);
    }

    warningAlert(title = '', message = '') {
        this.baseAlert('warning', title, message);
    }

    warningAlertWithTable(data, table) {
        Swal.fire({
            icon: 'warning',
            position: 'center',
            html: ` <small><strong>${data.message}</strong></small></br>
                            <small>Datos Correctos: <strong>${data.response[0]['success']}</strong> de <strong>${data.response[0]['total']}</strong></small></br>
                            <small>Datos Fallidos: <strong>${data.response[0]['failed']}</strong></small><br><br>
                            <small><strong>Alumnos que no se guardaron</strong></small><br>${table}`,
            showCloseButton: true,
            confirmButtonColor: 'var(--primary)'
        })
    }

    successAlertWithoutTable(data) {
        Swal.fire({
            icon: 'success',
            position: 'center',
            html: ` <small><strong>${data.message}</strong></small></br>
                            <small>Datos Correctos: <strong>${data.response[0]['success']}</strong> de <strong>${data.response[0]['total']}</strong></small></br>
                            <small>Datos Fallidos: <strong>${data.response[0]['failed']}</strong></small><br>`,
            showCloseButton: true,
            confirmButtonColor: 'var(--primary)'
        })
    }

}