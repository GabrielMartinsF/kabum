import axios from "axios"
import { authHeader } from "./Auth"

const apiUrl = "http://localhost/kabum/api/"

class AdressService {
    fetch() {
        return axios.get(apiUrl + "address/fetch", {
            headers: authHeader()
        })
    }

    adicionar(payload) {
        return axios.post(apiUrl + "address/create", payload, {
            headers: authHeader()
        })
    }

    editar(payload) {
        console.log(payload)
        return axios.put(apiUrl + `address/${payload.id_endereco}/update`, payload, {
            headers: authHeader()
        })
    }

    deletar(id) {
        return axios.delete(apiUrl + `address/${id}/delete`, {
            headers: authHeader()
        })
    }    
}

export default new AdressService();