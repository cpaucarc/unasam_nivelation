class Badge {
    constructor() {
    }

    createBadge(text, numero) { //1 no nec, 2 si, pero no obl, 3 obl
        let small = document.createElement('small');
        let span = document.createElement('span');
        small.appendChild(document.createTextNode(text));
        span.appendChild(small);
        span.classList.add('px-2');
        span.classList.add('py-1');
        span.classList.add('alert');
        switch (parseInt(numero)) {
            case 1: { // No requiere
                span.classList.add('alert-success');
                break;
            }
            case 2: { // requiere, no obligatorio
                span.classList.add('alert-warning');
                break;
            }
            case 3: { // si requiere, obligatorio
                span.classList.add('alert-danger');
                break;
            }
            default: { // si requiere, obligatorio
                span.classList.add('badge-danger');
                break;
            }
        }
        return span;
    }

    createBadgeForJob(text, numero) { //1 activo, 0 despedido
        let small = document.createElement('small');
        let span = document.createElement('span');
        small.appendChild(document.createTextNode(text));
        span.appendChild(small);
        span.classList.add('px-2');
        span.classList.add('py-0');
        span.classList.add('alert');
        if (parseInt(numero) === 0) {
            span.classList.add('alert-danger');
        } else {
            span.classList.add('alert-success');
        }
        return span;
    }

}