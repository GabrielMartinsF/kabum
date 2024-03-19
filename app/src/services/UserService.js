import axios from "axios"
import { authHeader } from "./Auth"

const apiUrl = "http://localhost/kabum/api/"

class UserService {
    login(user) {
        return axios.post(apiUrl + "users/login", user, {
           
        });
    }

    cadastro(payload) {
        return axios.post(apiUrl + "users/create", payload, {
            headers: authHeader()
        })
    }
}

export default new UserService();