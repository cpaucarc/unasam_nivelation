class CardArea {
    constructor() {
    }

    createCardArea(area, desc, btnShow) {
        let card = document.createElement('div');
        card.classList.add('card');
        card.appendChild(this.createCardHeader(area));
        card.appendChild(this.createCardBody(desc, btnShow));
        return card;
    }

    createCardHeader(area) {
        let header = document.createElement('div');
        header.classList.add('card-header');
        header.classList.add('text-center');
        header.classList.add('p-1');

        let cmpText = document.createElement('h6');
        cmpText.classList.add('text-md');
        cmpText.classList.add('font-weight-bold');
        cmpText.classList.add('text-primary');
        cmpText.classList.add('my-1');
        cmpText.appendChild(document.createTextNode('Área '))

        let span = document.createElement('span');
        span.classList.add('badge');
        span.classList.add('bg-primary');
        span.classList.add('text-light');
        span.appendChild(document.createTextNode(area));

        cmpText.appendChild(span);
        header.appendChild(cmpText);
        return header;
    }

    createCardBody(desc, btnShow) {
        let body = document.createElement('div');
        body.classList.add('card-body');
        body.classList.add('text-center');
        body.classList.add('py-2');
        body.classList.add('px-1');
        let span = document.createElement('span');
        let small = document.createElement('small');
        span.classList.add('text-dark');
        small.appendChild(document.createTextNode(desc));
        span.appendChild(small);
        body.appendChild(span);
        body.appendChild(btnShow);
        return body;
    }
}