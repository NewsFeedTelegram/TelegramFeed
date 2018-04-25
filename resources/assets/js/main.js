import Vue from 'vue'
import router from './router'

import AppIndex from './App'


const app = new Vue({
    el: '#app',
    components: {AppIndex},
    router,
});
