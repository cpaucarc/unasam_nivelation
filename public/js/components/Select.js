class Select {
    constructor() {
    }

    createOption(value, text) {
        let opt = document.createElement('option');
        opt.setAttribute("value", value);
        opt.innerText = text;
        return opt;
    }

}