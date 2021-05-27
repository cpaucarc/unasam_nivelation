const time_start = document.getElementById('time_start');
const time_end = document.getElementById('time_end');
const dateHelp = document.getElementById('dateHelpBlock');
const timeHelp = document.getElementById('timeHelpBlock');
const btSaveSchedule = document.getElementById('saveSchedule');

//Time verify
time_start.onchange = () => {
    verifyTimeDiff(time_start.value, time_end.value);
}

time_end.onchange = () => {
    verifyTimeDiff(time_start.value, time_end.value);
}

function verifyTimeDiff(tstart, tend) {
    let time7 = new Date(`2021-04-17 07:00`);
    let timeEnd = new Date(`2021-04-17 ${tend}`);
    let timeStart = new Date(`2021-04-17 ${tstart}`);
    let time21 = new Date(`2021-04-17 21:00`);

    if (timeStart >= time7) {
        time_start.classList.remove('is-invalid');
        time_start.classList.add('is-valid');
        timeHelp.innerText = ``;
        if (timeEnd <= time21) {
            if (timeEnd > timeStart) {
                let minutes = getTimeDiffInMinutes(timeStart, timeEnd);
                let _sch = [120, 180, 240];
                if (minutes > 0) {
                    if (_sch.includes(minutes)) {
                        time_end.classList.remove('is-invalid');
                        time_end.classList.add('is-valid');
                        timeHelp.classList.add('text-success');
                        timeHelp.classList.remove('text-danger');
                        timeHelp.innerText = 'El horario es aceptable.';
                        button.disableButton(btSaveSchedule, false);
                    } else {
                        time_end.focus();
                        time_end.classList.add('is-invalid');
                        timeHelp.classList.add('text-danger');
                        timeHelp.innerText = `El horario debe tener 2, 3 o 4 horas de diferencia. Actualmente hay ${minutes} minutos de diferencia.`;
                        button.disableButton(btSaveSchedule, true);
                    }
                } else {
                    time_end.focus();
                    time_end.classList.add('is-invalid');
                    timeHelp.classList.add('text-danger');
                    timeHelp.innerText = `La hora final no puede ser menor a la hora de inicio.`;
                    button.disableButton(btSaveSchedule, true);
                }
            }
        } else {
            time_end.focus();
            time_end.classList.add('is-invalid');
            timeHelp.classList.add('text-danger');
            timeHelp.innerText = `La hora final no puede ser mayor a 21:00h.`;
            button.disableButton(btSaveSchedule, true);
        }
    } else {
        time_start.focus();
        time_start.classList.remove('is-valid');
        time_start.classList.add('is-invalid');
        timeHelp.classList.add('text-danger');
        timeHelp.innerText = `La hora de inicio debe ser mayor a 07:00h.`;
        button.disableButton(btSaveSchedule, true);
    }


}

function getTimeDiffInMinutes(tstart, tend) {
    try {
        let diffMs = (tend - tstart);
        let diffHrs = Math.floor((diffMs % 86400000) / 3600000); // hours
        let diffMins = Math.round(((diffMs % 86400000) % 3600000) / 60000); // minutes
        return diffHrs * 60 + diffMins;
    } catch (e) {
        return 0;
    }
}

//Date verify
date_start.onchange = () => {
    verifyDateDiff(date_start.value, date_end.value);
}

date_end.onchange = () => {
    verifyDateDiff(date_start.value, date_end.value);
}

function verifyDateDiff(dstart, dend) {
    let today = new Date();
    let dateStart = new Date(dstart);
    let dateEnd = new Date(dend);
    if (dateStart >= today) {
        date_start.classList.remove('is-invalid');
        date_start.classList.add('is-valid');
        dateHelp.innerText = ``;
        let days = getDateDiffInDays(dateStart, dateEnd);
        let MIN_DAY = 13;
        let MAX_DAY = 15;
        if (days < MIN_DAY || days > MAX_DAY) {
            date_end.focus();
            date_end.classList.add('is-invalid');
            dateHelp.classList.add('text-danger');
            dateHelp.innerText = `La duración debe ser de 2 semanas. Actualmente hay ${days} dias de diferencia`;
        } else {
            date_end.classList.remove('is-invalid');
            date_end.classList.add('is-valid');
            dateHelp.classList.add('text-success');
            dateHelp.classList.remove('text-danger');
            dateHelp.innerText = 'La duración es aceptable.';
        }
    } else {
        date_start.focus();
        date_start.classList.remove('is-valid');
        date_start.classList.add('is-invalid');
        dateHelp.classList.remove('text-success');
        dateHelp.classList.add('text-danger');
        dateHelp.innerText = 'La fecha de inicio debe ser mayor que hoy.';
    }
}

function getDateDiffInDays(dstart, dend) {
    try {
        return ((dend.getTime()) - (dstart.getTime())) / (1000 * 3600 * 24);
    } catch (e) {
        return 0;
    }
}