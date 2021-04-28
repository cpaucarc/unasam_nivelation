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
        let btn = this.createIconBtn('<i class="bi bi-pencil-square"></i>', fun, ...params);
        btn.classList.add('btn');
        btn.classList.add('btn-light');
        btn.classList.add('btn-sm');
        return btn;
    }

    createBtnDelete(fun, ...params) {
        let btn = this.createIconBtn('<i class="bi bi-trash"></i>', fun, ...params);
        btn.classList.add('btn');
        btn.classList.add('btn-outline-danger');
        return btn;
    }

    createIconAndTextBtn(icon, text, fun, ...params) {
        let btn = this.createIconBtn(icon, fun, ...params);
        btn.appendChild(document.createTextNode(text));
        btn.classList.add('btn');
        btn.classList.add('btn-light');
        btn.classList.add('text-primary');
        btn.classList.add('w-100');
        btn.classList.add('my-2');
        return btn;
    }

    createButtonForRedirectToStudentView(id) {
        let url = "estudiante";
        let btn = document.createElement('a');
        btn.classList.add('btn');
        btn.classList.add('btn-link');
        btn.classList.add('btn-sm');
        btn.setAttribute('href', `${url}/${id}`);
        // btn.setAttribute('target', '_blank');
        btn.setAttribute('role', 'button');
        btn.innerText = 'Ver';
        return btn;
    }

}