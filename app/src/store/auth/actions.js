import UserService from "src/services/UserService";
import jwt_decode from "jwt-decode";

export function login ({ commit }, user) {
  return UserService.logar(user)
    .then(response => {
      if (response.data.access_token) {
        const token = response.data.access_token
        const decoded = jwt_decode(token)

        commit('setToken', {
          token: token
        })

        commit('setUser', {
          authorities: decoded.authorities,
          name: decoded.user_name,
        })
      }

      return Promise.resolve()
    })
    .catch(e => {
      return Promise.reject(e)
    })
}

export function logout (state) {
  AuthService.logout()
  state.commit('setUser', null)
  state.commit('setToken', null)
}
