import axios from "axios"
import { authHeader } from "./Auth"

const apiUrl = "http://localhost/kabum/api/"

class ClientService {
    fetch() {
        return axios.get(apiUrl + "client/fetch", {
            headers: authHeader()
        })
    }


    deletar(id) {
        return axios.delete(apiUrl + `/client/${id}/delete`, {
            headers: authHeader()
        })
    }
}

export default new ClientService();