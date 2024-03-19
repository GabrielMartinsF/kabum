import UserService from "src/services/UserService";

export function goLogin ({ commit }, user) {
  return new Promise((resolve, reject) => {
    UserService.login(user)
      .then(response => {
        console.log(response.data.jwt)
        commit('setToken', response.data.jwt)
        commit('setLoggedIn', true)
        resolve()
      }).catch(e => {
        commit('setToken', null)
        reject(e)
      })
  })
}

export function logout (state) {
  state.commit('setToken', null)
  state.commit('setLoggedIn', false)
}
