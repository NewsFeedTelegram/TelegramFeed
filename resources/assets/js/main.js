import Vue from 'vue'
import router from './router'
import axios from 'axios'
import { store } from './store'
import VeeValidate from 'vee-validate';
import Vuebar from 'vuebar';
Vue.use(Vuebar);
Vue.use(require('vue-moment'));

import AppIndex from './App'

const token = localStorage[ 'access-token' ]

if ( token ) {
  axios.defaults.headers.common[ 'Authorization' ] = `${token}`;
  store.dispatch('REFRESH_TOKEN')
}

axios.interceptors.request.use ( function ( config ) {
  if ( token ) {
    axios.defaults.headers.common[ 'Authorization' ] = `${token}`;
  }
  return config;
}, function ( err ) {
  axios.interceptors.response.use ( undefined, function ( err ) {
    return new Promise ( function ( resolve, reject ) {
      if ( err.response.status === 401 && token ) {
        axios.get ( 'api/auth/refresh' )
          .then ( response => {
            store.dispatch('REFRESH_TOKEN')
            resolve(response)
          } )
          .catch ( error => {
            localStorage.removeItem ( 'access-token' )
            reject(error)
          } )
      }
      throw err;
    } );
  } );
  return Promise.reject ( err );
} );

window.axios = axios

router.beforeEach ( ( to, from, next ) => {
  document.documentElement.scrollTop = 0
  const nearestWithTitle = to.matched.slice ().reverse ().find ( r => r.meta && r.meta.title );
  const nearestWithMeta = to.matched.slice ().reverse ().find ( r => r.meta && r.meta.metaTags );
  const previousNearestWithMeta = from.matched.slice ().reverse ().find ( r => r.meta && r.meta.metaTags );
  if ( nearestWithTitle ) document.title = nearestWithTitle.meta.title;
  Array.from ( document.querySelectorAll ( '[data-vue-router-controlled]' ) ).map ( el => el.parentNode.removeChild ( el ) );
  if ( !nearestWithMeta ) return next ();
  nearestWithMeta.meta.metaTags.map ( tagDef => {
    const tag = document.createElement ( 'meta' );

    Object.keys ( tagDef ).forEach ( key => {
      tag.setAttribute ( key, tagDef[ key ] );
    } );
    tag.setAttribute ( 'data-vue-router-controlled', '' );

    return tag;
  } )
    .forEach ( tag => document.head.appendChild ( tag ) );
  next ();
} );

Vue.use ( VeeValidate );


if ( process.env.NODE_ENV === 'development' ) {
  axios.defaults.baseURL = ''
} else {
  axios.defaults.baseURL = 'http://newsfeed.test/'
}

const app = new Vue ( {
  el : '#app',
  components : { AppIndex },
  router,
  store
} );
