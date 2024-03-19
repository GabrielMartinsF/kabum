import { store } from 'quasar/wrappers'
import { createStore } from 'vuex'

import clients from './clients'
import auth from './auth'

export default store(function (/* { ssrContext } */) {
  const Store = createStore({
    modules: {
      clients,
      auth
    },
    strict: process.env.DEBUGGING
  })

  return Store
})
