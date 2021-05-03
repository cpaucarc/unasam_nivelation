class Badge {
    constructor() {
    }

    createBadge(text, numero) { //1 no nec, 2 si, pero no obl, 3 obl
        let small = document.createElement('small');
        let span = document.createElement('span');
        small.appendChild(document.createTextNode(text));
        span.appendChild(small);
        span.classList.add('py-2');
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

}