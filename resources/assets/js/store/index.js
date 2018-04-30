import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        token: localStorage.getItem('access-token') || '',
        status: '',
        user: {}
    },
    mutations: {
        AUTH_REQUEST: (state) => {
            state.status = 'loading'
        },
        AUTH_SUCCESS: (state, user) => {
            state.status = 'success';
            state.token = user.token;
            state.user = user
        },
        AUTH_ERROR: (state) => {
            state.status = 'error'
        },
        AUTH_LOGOUT: (state) => {
            state.user = {};
            state.status = ''
        },
    },
    actions: {
        AUTH_REQUEST: ({commit, dispatch}, user) => {
            return new Promise((resolve, reject) => {
                axios.post('api/auth/login', user)
                    .then(response => {
                        const user = response.data.data
                        console.log(user)
                        localStorage.setItem('access-token', user.token);
                        commit('AUTH_SUCCESS', user);
                        resolve(response)
                    })
                    .catch(err => {
                        commit('AUTH_ERROR', err);
                        localStorage.removeItem('access-token');
                        reject(err)
                    })
            })
        },
        AUTH_LOGOUT: ({commit, dispatch}) => {
            return new Promise((resolve, reject) => {
                commit('AUTH_LOGOUT')
                localStorage.removeItem('access-token')
                resolve()
            })
        },
        REGISTER_REQUEST: ({commit, dispatch}, data) => {
            return new Promise((resolve, reject) => {
                axios.post('api/auth/register', data)
                    .then(response => {
                        const user = response.data.data
                        localStorage.setItem('access-token', user.token);
                        commit('AUTH_SUCCESS', user);
                        resolve(response)
                    })
                    .catch(err => {
                        commit('AUTH_ERROR', err);
                        localStorage.removeItem('access-token');
                        reject(err)
                    })
            })
        }

    },
    getters: {
        isAuthenticated: state => !!state.token,
        authStatus: state => state.status,
        user: state => state.user
    }
});
