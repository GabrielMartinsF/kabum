import ClientService from "src/services/ClientService";

export function fetchClientes ({ getters, commit }) {
    return new Promise((resolve, reject) => {
        ClientService.fetch()
        .then(response => {
          console.log(response.data.data)
          commit('setClientes', response.data.data)
          resolve()
        }).catch(e => {
          commit('setClientes', null)
          reject(e)
        })
    })
}