import Vue from 'vue'
import Router from 'vue-router'

import Index from '../components/Index'
import AppFeed from '../components/Authorized/Feed'
import AppProfile from '../components/Authorized/Profile'
import { store } from '../store'

Vue.use ( Router )

const ifNotAuthenticated = ( to, from, next ) => {
  if ( !store.getters.isAuthenticated ) {
    next ()
    return
  }
  next ( '/' )
}

const ifAuthenticated = ( to, from, next ) => {
  if ( store.getters.isAuthenticated ) {
    next ()
    return
  }
  next ( '/' )
}


export default new Router ( {
  mode : 'history',
  routes : [
    {
      path : '/',
      name : 'Index',
      component : Index
    },
    {
      path : '/feed',
      name : 'NewsFeed',
      component : AppFeed,
      beforeEnter : ifAuthenticated,
      meta : {
        title : 'NewsFeed',
        metaTags : [
          {
            name : 'description',
            content : 'The about page of our example app.'
          },
          {
            property : 'og:description',
            content : 'The about page of our example app.'
          },
        ]
      },
    },
    {
      path : '/profile/:id',
      name : 'Profile',
      component : AppProfile,
      beforeEnter : ifAuthenticated,
      meta : {
        title : 'Profile',
        metaTags : [
          {
            name : 'description',
            content : 'The about page of our example app.'
          },
          {
            property : 'og:description',
            content : 'The about page of our example app.'
          },
        ]
      },
    },

  ]
} )
