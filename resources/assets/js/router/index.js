import Vue from 'vue'
import Router from 'vue-router'

import Index from '../components/Index'
import AppTest from '../components/Test'

Vue.use(Router)

import {store} from '../store'

const ifNotAuthenticated = (to, from, next) => {
    if (!store.getters.isAuthenticated) {
        next()
        return
    }
    next('/')
}

const ifAuthenticated = (to, from, next) => {
    if (store.getters.isAuthenticated) {
        next()
        return
    }
    next('/')
}


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
            component: AppTest,
            beforeEnter: ifAuthenticated,
        },
    ]
})
