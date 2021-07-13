import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from "vuex-persistedstate";

Vue.use(Vuex);

const initialState = {
  user: {}
}

const store = new Vuex.Store({
namespaced: true,
  state: initialState,
  mutations: {
    setuser(state,user) {
      return state.user = user
    }
  },
  plugins: [createPersistedState()]
});

export default store;