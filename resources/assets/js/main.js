import Vue from 'vue'
import router from './router'
import axios from 'axios'
import { store } from './store'
import VeeValidate from 'vee-validate';

import AppIndex from './App'

const token = localStorage[ 'access-token' ]


if ( token ) {
  axios.defaults.headers.common[ 'Authorization' ] = 'Bearer ' + token
}

window.axios = axios

router.beforeEach ( ( to, from, next ) => {
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
