class CardArea {
    constructor() {
    }

    createCardArea(area, desc, btnShow) {
        let card = document.createElement('div');
        card.classList.add('card');
        // card.classList.add('border-left-primary');
        // card.classList.add('shadow');
        card.appendChild(this.createCardHeader(area));
        card.appendChild(this.createCardBody(desc, btnShow));
        return card;
    }

    createCardHeader(area) {
        let header = document.createElement('div');
        header.classList.add('card-header');
        header.classList.add('text-center');

        let cmpText = document.createElement('div');
        cmpText.classList.add('text-md');
        cmpText.classList.add('font-weight-bold');
        cmpText.classList.add('text-primary');
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
        let span = document.createElement('span');
        // span.classList.add('text-uppercase');
        span.classList.add('text-dark');
        span.appendChild(document.createTextNode(desc));
        body.appendChild(span);
        body.appendChild(btnShow);

        return body;
    }

}