export function setClientes (state, data) {
    console.log(state, data)
    if (data) {
        state.clientes = data
    } else {
        state.clientes = null
    }
}
