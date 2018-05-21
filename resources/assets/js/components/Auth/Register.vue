<template>
  <form @submit.prevent="registerUser" id="formRegister">
    <h2>Register to Beautifullife</h2>
    <div class="form-group">
      <input type="text"
             class="form-control field"
             v-model="login"
             name="Login"
             v-validate="'required'"
             placeholder="Enter login">
      <span v-show="errors.has('Login')">{{ errors.first('Login') }}</span>
    </div>
    <div class="form-group">
      <input type="text"
             class="form-control field"
             name="First name"
             v-model="first_name"
             v-validate="'required'"
             placeholder="First name">
            <span v-show="errors.has('First name')">{{ errors.first('First name') }}</span>

    </div>
    <div class="form-group">
      <input type="text"
             class="form-control field"
             name="Last name"
             v-model="last_name"
             v-validate="'required'"
             placeholder="Last name">
            <span v-show="errors.has('Last name')">{{ errors.first('Last name') }}</span>

    </div>
    <div class="form-group">
      <input type="password"
             class="form-control field"
             name="Password"
             v-model="password"
             v-validate="'required'"
             placeholder="Password">
            <span v-show="errors.has('Password')">{{ errors.first('Password') }}</span>

    </div>
    <div class="form-group">
      <input type="password"
             class="form-control field"
             name="Password Confirmation"
             v-model="password_confirmation"
             v-validate="'required'"
             placeholder="Password confirm">
            <span v-show="errors.has('Password Confirmation')">{{ errors.first('Password Confirmation') }}</span>

    </div>
    <button class="btn">
      <svg class="icon icon-right-arrow">
        <use xlink:href="#icon-right-arrow"></use>
      </svg>
    </button>
    <p>Don’t you have an account? <a href="#" @click.prevent="$emit('register')">Login
      Now!</a> it’s realy simple
      and you can start enjoing all the benefits! </p>

  </form>
</template>

<script>
export default {
  data () {
    return {
      login : '',
      first_name : '',
      last_name : '',
      password : '',
      password_confirmation : ''
    }
  },
  methods : {
    registerUser () {
      const form = { login:this.login, first_name: this.first_name, last_name:this.last_name, password:this.password, password_confirmation:this.password_confirmation }
      this.$store.dispatch ( 'REGISTER_REQUEST', form )
        .then ( () => {
          this.$router.replace ( '/feed' )
        } )
    }
  }
}
</script>

<style scoped>

</style>