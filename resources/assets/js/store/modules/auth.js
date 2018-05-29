import axios from "axios/index";

const state = {
  token : false,
  status : '',
  refreshStatus: false,
  isAuthenticated: localStorage[ 'access-token' ],
  user : {},
  error : '',
  login_validate : {
    v_loading : false,
    v_error : false,
    v_success : false
  },
  isPreloader: true
}
const mutations = {
  AUTH_REQUEST : ( state ) => {
    state.status = 'loading'
  },
  AUTH_SUCCESS : ( state, user ) => {
    state.status = 'success';
    state.token = user.token;
    state.user = user
  },
  TOKEN: (state, status) => {
    state.refreshStatus = status
  },
  AUTH_ERROR : ( state, err ) => {
    state.status = 'error';
    state.error = err.response ? err.response.data.errors : ''
  },
  SET_TOKEN : ( state, token ) => {
    state.isAuthenticated = token
  },
  AUTH_LOGOUT : ( state ) => {
    state.user = {};
    state.status = ''
  },
  VALIDATE_STATUS : ( state, status ) => {
    state.login_validate.v_loading = status.v_loading
    state.login_validate.v_error = status.v_error
    state.login_validate.v_success = status.v_success
  },
  INDEX_PRELOADER: (state, status) => {
    state.isPreloader = status
  }
}
const actions = {
  /**
   * Получение данных пользователя
   *
   * @return {Promise}
   *
   */
  USER_PROFILE : ( { commit } ) => {
    return new Promise ( ( resolve, reject ) => {
      axios.get ( 'api/auth/me', {
        authorization: localStorage[ 'access-token' ]
      } )
        .then ( response => {
          const user = response.data.data
          commit ( 'AUTH_SUCCESS', user );
          resolve ( response )
        } )
        .catch ( err => {
          commit ( 'AUTH_ERROR', err );
          dispatch ( 'AUTH_LOGOUT' )
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
    commit('INDEX_PRELOADER', true)
    commit('TOKEN', false)
    return new Promise ( ( resolve, reject ) => {
      axios.post ( 'api/auth/login', user )
        .then ( response => {
          let user_data = {};
          user_data.token = response.headers.authorization
          user.token = response.headers.authorization
          localStorage.setItem ( 'access-token',  response.headers.authorization );
          axios.defaults.headers.common[ 'Authorization' ] = user.token
          commit ( 'AUTH_SUCCESS', user_data );
          dispatch('USER_PROFILE')
          commit ( 'AUTH_ERROR', '' );
          commit('TOKEN', true)
          commit('SET_TOKEN', user.token)
          setTimeout ( () => {
            commit('INDEX_PRELOADER', false)
          }, 300 )
          resolve ( response )
        } )
        .catch ( err => {
          commit('INDEX_PRELOADER', false)
          commit ( 'AUTH_ERROR', err );
          // localStorage.removeItem ( 'access-token' );
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
  AUTH_LOGOUT : ( { commit, state } ) => {
    axios.defaults.headers.common[ 'Authorization' ] = localStorage[ 'access-token' ]
    return new Promise ( ( resolve ) => {
      axios.post ( 'api/auth/logout', {
        authorization: localStorage[ 'access-token' ]
      } )
      commit ( 'AUTH_LOGOUT' )
      state.loadPost = true
      commit ( 'VALIDATE_STATUS', {
        v_loading : false,
        v_error : false,
        v_success : false
      } )
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
    commit('INDEX_PRELOADER', true)
    return new Promise ( ( resolve, reject ) => {
      axios.post ( 'api/auth/register', data )
        .then ( response => {
          let user = {};
          user.token = response.headers.authorization
          localStorage.setItem ( 'access-token', response.headers.authorization );
          axios.defaults.headers.common[ 'Authorization' ] = response.headers.authorization
          commit ( 'AUTH_SUCCESS', user )
          commit('SET_TOKEN', user.token)
          setTimeout ( () => {
            commit('INDEX_PRELOADER', false)
          }, 300 )
          resolve ( response )
        } )
        .catch ( err => {
          // commit ( 'AUTH_ERROR', err );
          commit('INDEX_PRELOADER', false)
          localStorage.removeItem ( 'access-token' );
          reject ( err )
        } )
    } )
  },
  /**
   * Проверка на существование логина     *
   * @param login {string}
   * @return {Promise}
   *
   */
  VALIDATE_LOGIN : ( { commit, dispatch }, login ) => {
    commit ( 'VALIDATE_STATUS', {
      v_loading : true,
      v_error : false,
      v_success : false
    } )
    return new Promise ( ( resolve, reject ) => {
      axios.post ( 'api/auth/register/validate/login', { login : login } )
        .then ( response => {
          commit ( 'VALIDATE_STATUS', {
            v_loading : false,
            v_error : false,
            v_success : true
          } )

          resolve ( response )
        } )
        .catch ( error => {
          commit ( 'VALIDATE_STATUS', {
            v_loading : false,
            v_error : true,
            v_success : false
          } )
          throw error
          reject ( error )
        } )
    } )
  },
  REFRESH_TOKEN : ({commit, dispatch}) => {
    return new Promise ( ( resolve, reject ) => {
      commit('TOKEN', false)
      axios.post ( 'api/auth/refresh', {
        authorization: localStorage[ 'access-token' ]
      } )
        .then ( response => {
          localStorage.setItem ( 'access-token', response.headers.authorization );
          axios.defaults.headers.common[ 'Authorization' ] = response.headers.authorization
          dispatch('USER_PROFILE')
          commit('TOKEN', true)
          resolve(response)
        } )
        .catch ( error => {
          localStorage.removeItem ( 'access-token' )
          reject ( error )
        } )
    })
  }
}
const getters = {
  isAuthenticated : state => !!state.isAuthenticated,
  authStatus : state => state.status,
  user : state => state.user,
  error : state => state.error,
  loginValidate : state => state.login_validate,
  isPreloader: state => state.isPreloader,
  refreshStatus: state=>state.refreshStatus
}

export default {
  state,
  getters,
  mutations,
  actions
}