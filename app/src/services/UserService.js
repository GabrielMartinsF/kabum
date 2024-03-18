import axios from "axios"
import { authHeader } from "./Auth"

const apiUrl = "http://localhost/kabum/api/"

class UserService {
    login(payload) {
        return axios.post(apiUrl + "users/login", payload, {
            headers: authHeader()
        })
    }

    cadastro(payload) {
        return axios.post(apiUrl + "users/create", payload, {
            headers: authHeader()
        })
    }
}

export default new UserService();