<template>
  <form @submit.prevent="registerUser" id="formRegister">
    <h2>Register to Beautifullife</h2>
    <div class="form-group">
      <span v-show="errors.has('Login')" class="error">{{ errors.first('Login') }}</span>
      <div class="valid-block">
        <input type="text"
               class="form-control field"
               v-model="login"
               name="Login"
               :class="{danger: errors.has('Login'), empty: empty.emptyLogin}"
               @input="validateLogin"
               v-validate="'required'"
               placeholder="Enter login">
        <span class="valid">
          <svg v-if="loginValidate.v_loading" version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
          viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve" width="40" height="40">
            <rect x="30" y="50" width="10" height="20" fill="#50bfa4">
              <animateTransform attributeType="xml"
                attributeName="transform" type="translate"
                values="0 0; 0 20; 0 0"
                begin="0" dur="0.6s" repeatCount="indefinite" />
            </rect>
            <rect x="50" y="50" width="10" height="20" fill="#50bfa4">
              <animateTransform attributeType="xml"
                attributeName="transform" type="translate"
                values="0 0; 0 20; 0 0"
                begin="0.2s" dur="0.6s" repeatCount="indefinite" />
            </rect>
            <rect x="70" y="50" width="10" height="20" fill="#50bfa4">
              <animateTransform attributeType="xml"
                attributeName="transform" type="translate"
                values="0 0; 0 20; 0 0"
                begin="0.4s" dur="0.6s" repeatCount="indefinite" />
            </rect>
        </svg>
          <svg v-if="loginValidate.v_success" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1"
               x="0px" y="0px" viewBox="0 0 286.054 286.054" style="enable-background:new 0 0 286.054 286.054;" xml:space="preserve" width="20" height="20" class="">
            <path d="M143.031,0C64.027,0,0.004,64.04,0.004,143.027c0,78.996,64.031,143.027,143.027,143.027
               c78.987,0,143.018-64.031,143.018-143.027C286.049,64.049,222.018,0,143.031,0z M143.031,259.236
                 c-64.183,0-116.209-52.026-116.209-116.209S78.857,26.818,143.031,26.818s116.2,52.026,116.2,116.209
                    S207.206,259.236,143.031,259.236z M199.241,82.187c-6.079-3.629-13.847-1.475-17.342,4.827l-47.959,86.147l-26.71-32.512
                       c-4.836-5.569-11.263-8.456-17.333-4.827c-6.079,3.638-8.591,12.39-4.657,18.004l37.169,45.241c2.78,3.611,5.953,5.775,9.27,6.392
                          l0.027,0.054l0.34,0.018c0.751,0.116,11.979,2.19,16.815-6.463l55.048-98.876C207.402,93.879,205.32,85.825,199.241,82.187z"
                  data-original="#3DB39E" class="active-path" data-old_color="#50bfa4" fill="#50bfa4"/>
          </svg>
          <svg v-if="loginValidate.v_error" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
             viewBox="0 0 286.054 286.054" style="enable-background:new 0 0 286.054 286.054;" xml:space="preserve" width="20" height="20">
            <path style="fill:#E2574C;" d="M168.352,142.924l25.28-25.28c3.495-3.504,3.495-9.154,0-12.64l-12.64-12.649
              c-3.495-3.486-9.145-3.495-12.64,0l-25.289,25.289l-25.271-25.271c-3.504-3.504-9.163-3.504-12.658-0.018l-12.64,12.649
              c-3.495,3.486-3.486,9.154,0.018,12.649l25.271,25.271L92.556,168.15c-3.495,3.495-3.495,9.145,0,12.64l12.64,12.649
              c3.495,3.486,9.145,3.495,12.64,0l25.226-25.226l25.405,25.414c3.504,3.504,9.163,3.504,12.658,0.009l12.64-12.64
              c3.495-3.495,3.486-9.154-0.009-12.658L168.352,142.924z M143.027,0.004C64.031,0.004,0,64.036,0,143.022
              c0,78.996,64.031,143.027,143.027,143.027s143.027-64.031,143.027-143.027C286.054,64.045,222.022,0.004,143.027,0.004z
               M143.027,259.232c-64.183,0-116.209-52.026-116.209-116.209s52.026-116.21,116.209-116.21s116.209,52.026,116.209,116.209
              S207.21,259.232,143.027,259.232z"/>
          </svg>
        </span>
      </div>
    </div>
    <div class="form-group">
      <span v-show="errors.has('First name')" class="error">{{ errors.first('First name') }}</span>

      <input type="text"
             class="form-control field"
             name="First name"
             :class="{danger: errors.has('First name'), empty: empty.emptyFirstName}"
             v-model="first_name"
             v-validate="'required'"
             placeholder="First name">
    </div>
    <div class="form-group">
      <span v-show="errors.has('Last name')" class="error">{{ errors.first('Last name') }}</span>

      <input type="text"
             class="form-control field"
             name="Last name"
             :class="{danger: errors.has('Last name'), empty: empty.emptyLastName}"
             v-model="last_name"
             v-validate="'required'"
             placeholder="Last name">
    </div>
    <div class="form-group">
      <span v-show="errors.has('Password')" class="error">{{ errors.first('Password') }}</span>
      <input type="password"
             class="form-control field"
             name="Password"
             :class="{danger: errors.has('Password'), empty: empty.emptyPass}"
             v-model="password"
             v-validate="'required|min:6'"
             placeholder="Password">
    </div>
    <div class="form-group">
      <span v-show="errors.has('Password Confirmation')"
            class="error">{{ errors.first('Password Confirmation') }}</span>

      <input type="password"
             class="form-control field"
             name="Password Confirmation"
             :class="{danger: errors.has('Password Confirmation'), empty: empty.emptyConfPass}"
             v-model="password_confirmation"
             v-validate="'required|confirmed:Password'"
             data-vv-validate-on="change"
             placeholder="Password confirm">
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
      password_confirmation : '',
      empty : {
        emptyLogin : false,
        emptyFirstName: false,
        emptyLastName: false,
        emptyPass : false,
        emptyConfPass: false
      }
    }
  },
  computed : {
    loginValidate () {
      return this.$store.getters.loginValidate
    }
  },
  methods : {
    validateLogin () {
      this.$store.dispatch ( 'VALIDATE_LOGIN', this.login )
    },
    registerUser () {
      const form = {
        login : this.login,
        first_name : this.first_name,
        last_name : this.last_name,
        password : this.password,
        password_confirmation : this.password_confirmation
      }
      if ( this.login !== '' && this.password !== '' && this.first_name !== '' && this.last_name !== '' && this.password_confirmation !=='') {
        this.$store.dispatch ( 'REGISTER_REQUEST', form )
          .then ( () => {
            this.$router.replace ( '/feed' )
          } )
      } else {
        if ( this.login === '' ) {
          console.log(this.errors.has)
          this.empty.emptyLogin = true
          setTimeout ( () => {
            this.empty.emptyLogin = false
          }, 1000 )
        } else if ( this.first_name === '' ) {
          this.empty.emptyFirstName = true
          setTimeout ( () => {
            this.empty.emptyFirstName = false
          }, 1000 )
        }
        else if ( this.last_name === '' ) {
          this.empty.emptyLastName = true
          setTimeout ( () => {
            this.empty.emptyLastName = false
          }, 1000 )
        }else if ( this.password === '' ) {
          this.empty.emptyPass = true
          setTimeout ( () => {
            this.empty.emptyPass = false
          }, 1000 )
        }else if ( this.password_confirmation === '' ) {
          this.empty.emptyConfPass = true
          setTimeout ( () => {
            this.empty.emptyConfPass = false
          }, 1000 )
        }
      }
    }
  }
}
</script>

<style scoped>
  .empty {
    animation: mymove 2s;
  }
  .error {
    color: #ff3c54;
    padding: 0;
  }

  .danger {
    border-color: #ff3c54 !important;
  }

</style>