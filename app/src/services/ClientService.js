import axios from "axios"
import { authHeader } from "./Auth"

const apiUrl = "http://localhost/kabum/api/"

class ClientService {
    fetch() {
        return axios.get(apiUrl + "client/fetch", {
            headers: authHeader()
        })
    }
}

export default new ClientService();