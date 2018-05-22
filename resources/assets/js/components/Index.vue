<template>
  <div>
    <div class="holder" v-show="isPreloader">
      <div class="preloader">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
      </div>
    </div>
    <header id="index-section" v-show="!isPreloader">
      <div class="container-fluid">
        <div class="row no-gutters bg-wrapper">
          <div class="col d-none d-sm-none d-md-block">
            <div class="bg">
              <div class="offset-md-1">
                <a href="#" class="logo"><img src="img/logo.png" alt="Beautifullife"></a>
              </div>
              <div class="row slogan_wrapper">
                <div class="col-md-11 offset-md-1">
                  <h1 class="slogan--text">
                    all news <br>
                    on one <br>
                    site
                  </h1>
                  <a href="#" class="btn btn-transparent" @click.prevent="register=!register">Register
                    Now</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-5 col-lg-4 col-xl-4">
            <div class="bg2">
              <div class="header col-md-12 d-sm-flex d-md-none">
                <a href="#" class="logo"><img src="img/logo_dark.png" alt="Beautifullife"></a>
                <a href="#" class="btn btn-transparent " @click.prevent="register=!register">Register
                  Now</a>
              </div>
              <app-login v-if="register" @register="change"></app-login>
              <app-register v-else @register="change"></app-register>
            </div>
          </div>
        </div>
      </div>
    </header>
  </div>

</template>

<script>
import AppLogin from '../components/Auth/Login'
import AppRegister from '../components/Auth/Register'
export default {
  data () {
    return {
      register : true,
    }
  },
  methods : {
    toggleState () {
      hideLoader ();
      this.$store.commit ( 'INDEX_PRELOADER', false );
    },
    change () {
      this.register = !this.register
    }
  },
  computed : {
    isPreloader () {
      return this.$store.getters.isPreloader
    },
    error () {
      return this.$store.getters.error
    }
  },
  components : {
    AppLogin,
    AppRegister
  },
  mounted () {
    window.onload = () => {
      let self = this
      setTimeout ( () => {
        self.toggleState ();
      }, 300 )
    }
  },
  beforeRouteEnter ( to, from, next ) {
    if ( window.localStorage[ 'access-token' ] && window.location.pathname === '/' ) {
      next ( vm => {
        vm.$router.replace ( { name : 'NewsFeed' } )
      } )
    }
    if ( from.name !== 'Index' ) {
      next ( vm => {
        vm.$store.commit ( 'INDEX_PRELOADER', false );
        vm.$store.commit ( 'INDEX_PRELOADER', true );
        vm.$store.commit ( 'INDEX_PRELOADER', false );
      } )
    }
    next ()
  },

}
</script>
<style scoped>
  .holder {
    background-color: #edf2f6;
  }

  .preloader div:before {
    background-color: #404257;
  }
</style>