import Vue from 'vue'
import Vuex from 'vuex'

Vue.use ( Vuex );

export const store = new Vuex.Store ( {
  state : {
    token : localStorage.getItem ( 'access-token' ) || '',
    status : '',
    user : {},
    error : ''
  },
  mutations : {
    AUTH_REQUEST : ( state ) => {
      state.status = 'loading'
    },
    AUTH_SUCCESS : ( state, user ) => {
      state.status = 'success';
      state.token = user.token;
      state.user = user
    },
    AUTH_ERROR : ( state, err ) => {
      state.status = 'error';
      state.error = err.response ? err.response.data.errors : ''
    },
    AUTH_LOGOUT : ( state ) => {
      state.user = {};
      state.status = ''
    },
  },
  actions : {
    /**
     * Получение данных пользователя
     *
     * @return {Promise}
     *
     */
    USER_PROFILE : ( { commit, dispatch }, user ) => {
      return new Promise ( ( resolve, reject ) => {
        axios.get ( 'api/auth/me' )
          .then ( response => {
            const user = response.data.data
            commit ( 'AUTH_SUCCESS', user );
            resolve ( response )
          } )
          .catch ( err => {
            commit ( 'AUTH_ERROR', err );
            reject ( err )
          } )
      } )
    },
    /**
     * Авторизация в системе и обработка запроса
     *
     * @param user {object}
     * @return {Promise}
     *
     */
    AUTH_REQUEST : ( { commit, dispatch }, user ) => {
      return new Promise ( ( resolve, reject ) => {
        axios.post ( 'api/auth/login', user )
          .then ( response => {
            const user = response.data.data
            localStorage.setItem ( 'access-token', user.token );
            // axios.defaults.headers.common[ 'Authorization' ] = 'Bearer ' + user.token
            commit ( 'AUTH_SUCCESS', user );
            commit ( 'AUTH_ERROR', '' );
            resolve ( response )
          } )
          .catch ( err => {
            commit ( 'AUTH_ERROR', err );
            localStorage.removeItem ( 'access-token' );
            commit ( 'AUTH_ERROR', err );
            reject ( err )
          } )
      } )
    },
    /**
     * Выход из системы
     *
     * @return {Promise}
     *
     */
    AUTH_LOGOUT : ( { commit } ) => {
      return new Promise ( ( resolve ) => {
        axios.post ( 'api/auth/logout' )
        commit ( 'AUTH_LOGOUT' )
        delete axios.defaults.headers.common[ 'Authorization' ]
        localStorage.removeItem ( 'access-token' )
        resolve ()
      } )
    },
    /**
     * Регистрация в системе и обработка запроса
     *
     * @param data {object}
     * @return {Promise}
     *
     */
    REGISTER_REQUEST : ( { commit, dispatch }, data ) => {
      return new Promise ( ( resolve, reject ) => {
        axios.post ( 'api/auth/register', data )
          .then ( response => {
            const user = response.data.data
            localStorage.setItem ( 'access-token', user.token );
            commit ( 'AUTH_SUCCESS', user );
            resolve ( response )
          } )
          .catch ( err => {
            commit ( 'AUTH_ERROR', err );
            localStorage.removeItem ( 'access-token' );
            console.log ( err.response.data.errors )
            reject ( err )
          } )
      } )
    }

  },
  getters : {
    isAuthenticated : state => !!state.token,
    authStatus : state => state.status,
    user : state => state.user,
    error : state => state.error
  }
} );

// import Vue from 'vue'
// import Vuex from 'vuex'
//
// Vue.use(Vuex)
//
// export const store = new Vuex.Store({
//   state : {},
//   mutations : {},
//   actions : {},
//   getters : {}
// })