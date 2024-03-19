import axios from "axios"
import { authHeader } from "./Auth"

const apiUrl = "http://localhost/kabum/api/"

class UserService {
    login(user) {
        const formData = new FormData();
        formData.append("username", user.username);
        formData.append("password", user.password);
        formData.append("grant_type", "password");

        return Vue.prototype.$axios.post(apiUrl + "users/login", formData, {
            headers: {
            ...authBasicHeader(this.clientId, this.secret),
            ...noTenant()
            },
            withCredentials: true
        });
    }

    cadastro(payload) {
        return axios.post(apiUrl + "users/create", payload, {
            headers: authHeader()
        })
    }
}

export default new UserService();