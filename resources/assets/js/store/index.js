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
        USER_PROFILE: ({commit, dispatch}, user) => {
            return new Promise((resolve, reject) => {
                axios.get('api/auth/me')
                    .then(response => {
                        const user = response.data.data
                        commit('AUTH_SUCCESS', user);
                        resolve(response)
                    })
                    .catch(err => {
                        commit('AUTH_ERROR', err);
                        reject(err)
                    })
            })
        },
        AUTH_REQUEST: ({commit, dispatch}, user) => {
            return new Promise((resolve, reject) => {
                axios.post('api/auth/login', user)
                    .then(response => {
                        const user = response.data.data
                        localStorage.setItem('access-token', user.token);
                        axios.defaults.headers.common['Authorization'] = 'Bearer ' + user.token
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
                axios.post('api/auth/logout')
                commit('AUTH_LOGOUT')
                delete axios.defaults.headers.common['Authorization']
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
