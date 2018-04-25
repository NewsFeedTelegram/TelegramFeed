import Vue from 'vue'
import Router from 'vue-router'

import AppIndex from '../components/Index'
import AppTest from '../components/Test'

Vue.use(Router)

export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'AppIndex',
            component: AppIndex
        },
        {
            path: '/test',
            name: 'Test',
            component: AppTest
        },
    ]
})
