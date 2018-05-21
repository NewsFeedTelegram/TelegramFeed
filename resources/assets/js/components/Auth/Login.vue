<template>
  <form @submit.prevent="loginUser" id="formLogin">
    <h2>Login to your Account</h2>
    <transition name="fade2" enter-active-class="animated pulse">
      <div class="error danger" v-show="error">
        <b>Не удалось войти.</b><br>
        {{error}}
      </div>
    </transition>
    <div class="form-group">
      <input type="text"
             class="form-control field"
             :class="{empty: empty.emptyLogin}"
             v-model="login"
             placeholder="Enter email">
    </div>
    <div class="form-group">
      <input type="password"
             class="form-control field"
             :class="{empty: empty.emptyPass}"
             v-model="password"
             placeholder="Enter password">
    </div>
    <div class="remember">
      <div class="form-group">
        <label class="container">Remember Me
          <input type="checkbox">
          <span class="checkmark"></span>
        </label>
      </div>
      <a href="#">Forgot my Password</a>
    </div>
    <button class="btn">
      <svg class="icon icon-right-arrow">
        <use xlink:href="#icon-right-arrow"></use>
      </svg>
    </button>
    <p>Don’t you have an account? <a href="" @click.prevent="$emit('register')">Register
      Now!</a> it’s realy simple
      and you can start enjoing all the benefits! </p>

  </form>
</template>

<script>
export default {
  props:['register'],
  data () {
    return {
      login : '',
      password : '',
      empty : {
        emptyLogin : false,
        emptyPass : false
      }
    }
  },
  methods : {
    loginUser () {
      const form = {
        login : this.login,
        password : this.password
      }
      if ( this.login !== '' && this.password !== '' ) {
        this.$store.dispatch ( 'AUTH_REQUEST', form )
          .then ( () => {
            this.$router.replace ( '/feed' )
          } )
      } else {
        if ( this.login === '' ) {
          this.empty.emptyLogin = true
          setTimeout ( () => {
            this.empty.emptyLogin = false
          }, 1000 )
        } else if ( this.password === '' ) {
          this.empty.emptyPass = true
          setTimeout ( () => {
            this.empty.emptyPass = false
          }, 1000 )
        }
      }
    },
  },
  computed : {
    error () {
      return this.$store.getters.error
    }
  },
}
</script>

<style scoped>
  .empty {
    animation: mymove 2s;
  }
</style>