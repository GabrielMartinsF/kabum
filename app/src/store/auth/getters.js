export function token (state) {
  return state.token
}

export function user (state) {
  return state.user
}

export function authorities (state) {
  return state.user?.authorities
}

export function loggedIn (state) {
  return state.user !== null
}


export function hasAuthority (state, getters) {
  return (authority) => {
    const authorities = getters.authorities;
    return authorities && authorities.includes(authority);
  }
}
