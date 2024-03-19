import { store } from 'quasar/wrappers'
import { createStore } from 'vuex'

import clients from './clients'

export default store(function (/* { ssrContext } */) {
  const Store = createStore({
    modules: {
      clients
    },
    strict: process.env.DEBUGGING
  })

  return Store
})
