import axios from "axios"
import { authHeader } from "./Auth"

const apiUrl = "http://localhost/kabum/api/"

class ClientService {
    fetch() {
        return axios.get(apiUrl + "client/fetch", {
            headers: authHeader()
        })
    }

    adicionar(payload) {
        return axios.post(apiUrl + "client/create", payload, {
            headers: authHeader()
        })
    }

    editar(payload, id) {
        return axios.put(apiUrl + `client/${id}/update`, payload, {
            headers: authHeader()
        })
    }

    deletar(id) {
        return axios.delete(apiUrl + `client/${id}/delete`, {
            headers: authHeader()
        })
    }    
}

export default new ClientService();