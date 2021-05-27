class Schedule {
    constructor(day, time_start, time_end) {
        this.id = Math.round(Math.random() * 10000);
        this.day = day;
        this.time_start = time_start;
        this.time_end = time_end;
    }

    getId() {
        return this.id;
    }

    getDay() {
        return this.day;
    }

    getTimeStart() {
        return this.time_start;
    }

    getTimeEnd() {
        return this.time_end;
    }

    getHours() {
        return this.getMinutes() / 60;
    }

    getMinutes() {
        let timeEnd = new Date(`2021-04-17 ${this.time_end}`);
        let timeStart = new Date(`2021-04-17 ${this.time_start}`);
        return getTimeDiffInMinutes(timeStart, timeEnd);
    }

    getTimeDiffInMinutes(tstart, tend) {
        try {
            let diffMs = (tend - tstart);
            let diffHrs = Math.floor((diffMs % 86400000) / 3600000); // hours
            let diffMins = Math.round(((diffMs % 86400000) % 3600000) / 60000); // minutes
            return diffHrs * 60 + diffMins;
        } catch (e) {
            return 1;
        }
    }

}