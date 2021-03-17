class Button {
    constructor() {
    }

    createBasicBtn(text, fun, ...params) {
        let basicBtn = document.createElement('button');

        let textContent = document.createTextNode(text);
        basicBtn.appendChild(textContent);

        if (fun) {
            basicBtn.addEventListener("click", function () {
                fun(...params);
            }, false);
        }

        return basicBtn;
    }

    createIconBtn(text, fun, ...params) {
        let iconBtn = document.createElement('button');

        iconBtn.innerHTML = text;

        if (fun) {
            iconBtn.addEventListener("click", function () {
                fun(...params);
            }, false);
        }

        return iconBtn;
    }

    createBtnPrimary(text, fun, ...params) {
        let btn = this.createBasicBtn(text, fun, ...params);
        btn.classList.add('btn');
        btn.classList.add('btn-primary');
        return btn;
    }

    createBtnEdit(fun, ...params) {
        let btn = this.createIconBtn('<i class="fas fa-pen"></i>', fun, ...params);
        btn.classList.add('btn');
        btn.classList.add('btn-outline-info');
        return btn;
    }

    createBtnDelete(fun, ...params) {
        let btn = this.createIconBtn('<i class="fas fa-trash"></i>', fun, ...params);
        btn.classList.add('btn');
        btn.classList.add('btn-outline-danger');
        return btn;
    }

}