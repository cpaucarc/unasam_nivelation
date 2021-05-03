class Table {

    constructor() {
    }

    createLightTable(tbody = 'tbody', ...headers) {

        let tb = document.createElement('table');
        tb.classList.add('table');
        //Header
        let thead = document.createElement('thead');
        thead.classList.add('thead-light');
        let thRow = document.createElement('tr');
        //Body
        let tbd = document.createElement('tbody');
        tbd.setAttribute("id", tbody);

        headers.forEach(head => {
            let th = this.createHeaderColumn(head);
            thRow.appendChild(th);
        });

        thead.appendChild(thRow);
        tb.appendChild(tbd);
        tb.appendChild(thead);

        return tb;
    }

    createHeaderColumn(text) {
        let th = document.createElement('th');
        let textContent = document.createTextNode(text);
        th.appendChild(textContent);
        return th;
    }

    createRow(...body) {
        let row = document.createElement('tr');
        row.classList.add('my-auto');
        body.forEach(bd => {
            row.appendChild(this.createBodyColumn(bd));
        });

        return row;
    }

    createCell(child) {
        let cell = document.createElement('td');
        cell.appendChild(child);
        return cell;
    }

    createFirstBodyColumn(text) {
        return this.createHeaderColumn(text);
    }

    createBodyColumn(text) {
        let td = document.createElement('td');
        let small = document.createElement('small');
        let textContent = document.createTextNode(text);
        small.appendChild(textContent);
        td.appendChild(small);
        return td;
    }

    appendColumnInRow(row, column) {
        row.appendChild(column);
        return row;
    }

}