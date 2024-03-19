export function setToken (state, data) {
  if (data) {
    state.token = data
    localStorage.setItem('token', state.token);
  } else {
    localStorage.removeItem('token');
    state.token = null
  }
}

export function setLoggedIn (state, data) {
  if (data) {
      state.loggedIn = data
  } else {
      state.loggedIn = null
  }
}