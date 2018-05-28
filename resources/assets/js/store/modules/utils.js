import axios from "axios/index";

const state = {
  modalAddChanelTelegram : {
    open : false
  },
  statusAddRequest: false
}
const mutations = {
  TOGGLE_MODAL_TELEGRAM : ( state ) => {
    state.modalAddChanelTelegram.open = !state.modalAddChanelTelegram.open
  },
  STATUS_ADD_CHANNEL: (state) => {
    state.statusAddRequest = !state.statusAddRequest
  }
}
const actions = {
  ADD_CHANNEL : ( { commit }, link ) => {
    commit('STATUS_ADD_CHANNEL')
    return new Promise ( ( resolve, reject ) => {
      axios.defaults.headers.common[ 'Authorization' ] = localStorage[ 'access-token' ]
      axios.post ( 'api/telegram_channel', { link } )
        .then ( response => {
          commit('STATUS_ADD_CHANNEL')
          resolve(response)
        },(err)=>{
          commit('STATUS_ADD_CHANNEL')
        } )

    } )
  }
}
const getters = {
  modalAddChanelTelegram : state => state.modalAddChanelTelegram,
  statusAddRequest: state => state.statusAddRequest
}

export default {
  state,
  getters,
  mutations,
  actions
}