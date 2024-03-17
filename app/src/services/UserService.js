import Vue from "vue"
import { authHeader } from "./Auth"

const apiUrl = "http://localhost/kabum/api/"

class UserService {
    login(payload) {
        return Vue.prototype.$axios.post(apiUrl + "", payload, {
            headers: authHeader()
        })
    }
}

export default new UserService();