class Alert {

    constructor() {
    }

    makeAlert() {
        let alert = document.createElement('div');
        alert.classList.add('modal')
        alert.classList.add('fade')
        alert.setAttribute('data-backdrop', 'static')

        let modalDialog = document.createElement('div')
        modalDialog.classList.add('modal-dialog')
        alert.appendChild(modalDialog)
        let modalContent = document.createElement('div')
        modalContent.classList.add('modal-content')
        modalDialog.appendChild(modalContent)
        let modalBody = document.createElement('div')
        modalBody.classList.add('modal-body')
        modalContent.appendChild(modalBody)

        let row = document.createElement('div')
        row.classList.add('row')

        let colIcon = document.createElement('div')
        colIcon.classList.add('col-3')
        colIcon.classList.add('text-warning')
        colIcon.classList.add('my-auto')
        let colText = document.createElement('div')
        colText.classList.add('col-9')
        colText.classList.add('text-dark')
        // Aun falta algunos componentes
    }

    makeAlertBody() {

    }

    makeAlertFooter() {
        let footer = document.createElement('div')
        footer.classList.add('modal-footer')

        let button = document.createElement('button')
        button.classList.add('btn')
        button.classList.add('btn-light')
        button.classList.add('font-weight-bold')
        button.setAttribute('data-dismiss', 'modal')
        button.appendChild(document.createTextNode('Cerrar ventana'))

        footer.appendChild(button)
    }

    a = `<div class="modal fade" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-3 text-warning my-auto">
                            <i class="fa fa-exclamation-triangle fa-5x" aria-hidden="true"></i>
                        </div>
                        <div class="col-9 text-dark">
                            <h3> Error</h3>
                            <p> text </p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light btn-sm font-weight-bold" data-dismiss="modal">
                        Cerrar ventana
                    </button>
                </div>
            </div>
        </div>
    </div>`;


}