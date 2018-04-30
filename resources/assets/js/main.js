import Vue from 'vue'
import router from './router'
import axios from 'axios'
import config from './config'
import {store} from './store'

import AppIndex from './App'

axios.defaults.baseURL = 'http://newsfeed.test/'

const token = localStorage.getItem('access-token')
if (token) {
    axios.defaults.headers.common['Authorization'] = token
}

window.axios = axios





const app = new Vue({
    el: '#app',
    components: {AppIndex},
    router,
    store
});
