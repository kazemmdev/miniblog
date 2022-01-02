import Vue from "vue"
import Vuex from "vuex"

Vue.use(Vuex)

const store = {
    state: {
        isLoggedIn: false,
        user: {
            id: null,
            name: null,
            email: null
        }
    },
    mutations: {
        SET_LOGGED(state, value) {
            state.isLoggedIn = value
        },
        SET_USER(state, value) {
            state.user = value
        }
    },
    actions: {
        async setLoggedIn({commit}, value) {
            commit('SET_LOGGED', value)
            localStorage.setItem('isLoggedIn', value)
        },
        async fetchCurrentUser({commit, dispatch}) {
            await axios.get('me').then(response => {

                const user = response.data.data

                if (user?.id) {
                    dispatch('setLoggedIn', true)
                    commit('SET_USER', user)
                } else {
                    dispatch('setLoggedIn', false)
                    commit('SET_USER', {
                        id: null,
                        name: null,
                        email: null
                    })
                }

            }).catch(() => {
                dispatch('setLoggedIn', false)
                commit('SET_USER', {
                    id: null,
                    name: null,
                    email: null
                })
            })
        },
        async logout({commit, dispatch}) {
            await axios.get('logout').then(() => {
                dispatch('setLoggedIn', false)
                commit('SET_USER', {
                    id: null,
                    name: null,
                    email: null
                })
            })
        },
    }
}

export default new Vuex.Store(store)
