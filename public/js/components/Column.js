class Column {

    constructor() {
    }

    createColumn(size) {
        let div = document.createElement('div');
        div.classList.add('col');
        div.classList.add(`col-lg-${size}`);
        div.classList.add(`col-md-4`);
        div.classList.add(`col-sm-6`);
        div.classList.add(`col-12`);
        div.classList.add(`mb-2`);
        return div;
    }

}