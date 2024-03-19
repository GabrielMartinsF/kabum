import { Notify } from "quasar";

class NotifyService {
    error (msg) {
        Notify.create({
            type: 'negative',
            message: msg,
            color: 'red'
        })
    }

    warning (message) {
        Notify.create({
            type: 'warning',
            message: message,
            color: 'yellow'
        })
    }
    success (message) {
        Notify.create({
            type: 'positive',
            message: message,
            color: 'green'
        })
    }

    info (message) {
        Notify.create({
            message: message,
            color: 'blue'
        })
    }

    infoTopSide (message) {
        Notify.create({
            message: message,
            color: 'blue',
            position: 'top-right'
        })
    }
}

export default new NotifyService();