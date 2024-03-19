export function setClientes (state, data) {
    if (data) {
        state.clientes = data
    } else {
        state.clientes = null
    }
}
