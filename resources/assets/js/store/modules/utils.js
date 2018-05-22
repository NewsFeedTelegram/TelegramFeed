const state = {
  modalAddChanelTelegram: {
    open: false
  }
}
const mutations = {
  TOGGLE_MODAL_TELEGRAM : (state) => {
    state.modalAddChanelTelegram.open = !state.modalAddChanelTelegram.open
  }
}
const actions = {}
const getters = {
  modalAddChanelTelegram: state => state.modalAddChanelTelegram
}

export default {
  state,
  getters,
  mutations,
  actions
}