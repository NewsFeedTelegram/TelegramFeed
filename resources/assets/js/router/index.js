import Vue from 'vue'
import Router from 'vue-router'

import Index from '../components/Index'
import AppTest from '../components/Test'

Vue.use(Router)

export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'Index',
            component: Index
        },
        {
            path: '/test',
            name: 'Test',
            component: AppTest
        },
    ]
})
