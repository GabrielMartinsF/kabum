export function setUser (state, data) {
  if (data) {
    localStorage.setItem('user', JSON.stringify(data));
    localStorage.setItem('authorities', JSON.stringify(data.authorities))

    state.user = { ...data }

  } else {
    localStorage.removeItem('user');
    localStorage.removeItem('authorities')
    state.user = null
  }

}

export function setToken (state, data) {
  if (data) {
    state.token = data.token
    localStorage.setItem('token', state.token);
  } else {
    localStorage.removeItem('token');
    state.token = null
  }
}

export function initialiseStore (state) {

  if (localStorage.getItem('token')) {
    setToken(state, {
      token: localStorage.getItem('token')
    })
  }

  if (localStorage.getItem('user')) {
    setUser(state, JSON.parse(localStorage.getItem('user')))
  }

}