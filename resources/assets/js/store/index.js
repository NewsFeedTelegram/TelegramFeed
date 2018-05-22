import Vue from 'vue'
import Vuex from 'vuex'

import auth from './modules/auth'
import utils from './modules/utils'

Vue.use ( Vuex );

export const store = new Vuex.Store ( {
  modules : {
    auth,
    utils
  }
} );
