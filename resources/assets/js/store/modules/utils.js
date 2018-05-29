import axios from "axios/index";

const state = {
  modalAddChanelTelegram : {
    open : false
  },
  listChannel : [],
  listPost : [],
  loadPost : true,
  loadMore : false,
  statusAddRequest : false
}
const mutations = {
  TOGGLE_MODAL_TELEGRAM : ( state ) => {
    state.modalAddChanelTelegram.open = !state.modalAddChanelTelegram.open
  },
  STATUS_ADD_CHANNEL : ( state ) => {
    state.statusAddRequest = !state.statusAddRequest
  },
  LIST_CHANNEL : ( state, list ) => {
    state.listChannel = list
  },
  LIST_POST : ( state, post ) => {
    state.listPost = post
    state.loadPost = false
  },
  LOAD_MORE : (state, post) => {
    state.listPost = state.listPost.concat(post)
    state.loadMore = false
  }
}
const actions = {
  ADD_CHANNEL : ( { commit, dispatch }, link ) => {
    commit ( 'STATUS_ADD_CHANNEL' )
    return new Promise ( ( resolve, reject ) => {
      axios.defaults.headers.common[ 'Authorization' ] = localStorage[ 'access-token' ]
      axios.post ( 'api/telegram/channel', { link } )
        .then ( response => {
          commit ( 'STATUS_ADD_CHANNEL' )
          dispatch ( 'LIST_CHANNEL' )
          resolve ( response )
        }, ( err ) => {
          commit ( 'STATUS_ADD_CHANNEL' )
        } )

    } )
  },
  LIST_CHANNEL : ( { commit }, link ) => {
    return new Promise ( ( resolve, reject ) => {
      axios.defaults.headers.common[ 'Authorization' ] = localStorage[ 'access-token' ]
      axios.get ( 'api/telegram/channel' )
        .then ( response => {
          commit ( 'LIST_CHANNEL', response.data.data )
          resolve ( response )
        }, ( err ) => {
          commit ( 'STATUS_ADD_CHANNEL' )
        } )

    } )
  },
  LIST_POST : ( { commit, state }, link ) => {
    axios.defaults.headers.common[ 'Authorization' ] = localStorage[ 'access-token' ]
    state.loadPost = true
    return new Promise ( ( resolve, reject ) => {
      axios.get ( 'api/telegram/posts/' )
        .then ( response => {
          commit ( 'LIST_POST', response.data.data )
          resolve ( response )
        }, ( err ) => {
          commit ( 'STATUS_ADD_CHANNEL' )
        } )

    } )
  },
  LOAD_MORE_POST : ({commit, state}) =>{
    let lastPost = state.listPost.length-1
    state.loadMore = true
    axios.defaults.headers.common[ 'Authorization' ] = localStorage[ 'access-token' ]
    return new Promise ( ( resolve, reject ) => {
      axios.get ( 'api/telegram/posts/', {
        params:{
          id: state.listPost[lastPost].id
        }
      })
        .then ( response => {
          commit('LOAD_MORE', response.data.data)
          resolve ( response )
        }, ( err ) => {
          commit ( 'STATUS_ADD_CHANNEL' )
        } )

    } )
  }
}
const getters = {
  modalAddChanelTelegram : state => state.modalAddChanelTelegram,
  statusAddRequest : state => state.statusAddRequest,
  listChannel : state => state.listChannel.reverse (),
  listPost : state => state.listPost,
  loadPost : state => state.loadPost,
  loadMore: state => state.loadMore
}

export default {
  state,
  getters,
  mutations,
  actions
}