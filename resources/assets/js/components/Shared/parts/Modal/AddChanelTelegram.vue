<template>
  <transition name="fade">
    <div class="modal_wrapper" v-if="open" @click.self.prevent="closeModal">
      <div class="container">
        <div class="row" @click.self.prevent="closeModal">
          <div class="col-xl-6 offset-xl-3">
            <div class="modal_container white-block">
              <div class="modal_header">
                <h2>Add Telegram Chanel</h2>
                <button class="btn btn-cancel" @click.prevent="closeModal">
                  <svg class="icon icon-cancel">
                    <use xlink:href="#icon-cancel"></use>
                  </svg>
                </button>
              </div>
              <div class="modal_body">
                <div v-if="!checked" class="modal_body_wrapper">
                  <div class="form-group">
                    <input type="text" class="field" v-model="link" placeholder="Chanel link" @keyup.enter="addChannel">
                  </div>
                  <button class="btn btn-green" :class="{'wait': load}" :disabled="load" @click="addChannel" >Add
                    Chanel
                  </button>
                </div>
                <div v-else class="modal_body_wrapper">
                  <div class="check_mark">
                    <div class="sa-icon sa-success animate">
                      <span class="sa-line sa-tip animateSuccessTip"></span>
                      <span class="sa-line sa-long animateSuccessLong"></span>
                      <div class="sa-placeholder"></div>
                      <div class="sa-fix"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>

<script>
export default {
  data () {
    return {
      link : '',
      checked : false
    }
  },
  computed : {
    open () {
      return this.$store.getters.modalAddChanelTelegram.open
    },
    load () {
      return this.$store.getters.statusAddRequest
    }
  },
  methods : {
    checkeds () {
      this.checked = !this.checked
      setTimeout ( () => {
        this.checked = !this.checked
      }, 1500 )
    },
    addChannel () {
      if ( this.link ) {
        this.$store.dispatch ( 'ADD_CHANNEL', this.link )
          .then ( () => {
            this.link = ''
            this.checkeds ()
            // this.closeModal()
          } )
      }
    },
    closeModal () {
      this.$store.commit ( 'TOGGLE_MODAL_TELEGRAM' )
    }
  },
  mounted () {
    window.addEventListener ( 'keyup', ( event ) => {
      if ( event.keyCode === 27 && this.open ) {
        this.closeModal ()
      }
    } )
  }
}
</script>

<style scoped lang="scss">
  .check_mark {
    width: 80px;
    height: 107px;
    margin: 0 auto;
  }

  button {
    cursor: pointer;
    margin-left: 15px;
  }

  .hide {
    display: none;
  }

  .sa-icon {
    width: 80px;
    height: 80px;
    border: 4px solid gray;
    -webkit-border-radius: 40px;
    border-radius: 40px;
    border-radius: 50%;
    margin: 20px auto;
    padding: 0;
    position: relative;
    box-sizing: content-box;
  }

  .sa-icon.sa-success {
    border-color: #4CAF50;
  }

  .sa-icon.sa-success::before, .sa-icon.sa-success::after {
    content: '';
    -webkit-border-radius: 40px;
    border-radius: 40px;
    border-radius: 50%;
    position: absolute;
    width: 60px;
    height: 120px;
    background: white;
    -webkit-transform: rotate(45deg);
    transform: rotate(45deg);
  }

  .sa-icon.sa-success::before {
    -webkit-border-radius: 120px 0 0 120px;
    border-radius: 120px 0 0 120px;
    top: -7px;
    left: -33px;
    -webkit-transform: rotate(-45deg);
    transform: rotate(-45deg);
    -webkit-transform-origin: 60px 60px;
    transform-origin: 60px 60px;
  }

  .sa-icon.sa-success::after {
    -webkit-border-radius: 0 120px 120px 0;
    border-radius: 0 120px 120px 0;
    top: -11px;
    left: 30px;
    -webkit-transform: rotate(-45deg);
    transform: rotate(-45deg);
    -webkit-transform-origin: 0px 60px;
    transform-origin: 0px 60px;
  }

  .sa-icon.sa-success .sa-placeholder {
    width: 80px;
    height: 80px;
    border: 4px solid rgba(76, 175, 80, .5);
    -webkit-border-radius: 40px;
    border-radius: 40px;
    border-radius: 50%;
    box-sizing: content-box;
    position: absolute;
    left: -4px;
    top: -4px;
    z-index: 2;
  }

  .sa-icon.sa-success .sa-fix {
    width: 5px;
    height: 90px;
    background-color: white;
    position: absolute;
    left: 28px;
    top: 8px;
    z-index: 1;
    -webkit-transform: rotate(-45deg);
    transform: rotate(-45deg);
  }

  .sa-icon.sa-success.animate::after {
    -webkit-animation: rotatePlaceholder 4.25s ease-in;
    animation: rotatePlaceholder 4.25s ease-in;
  }

  .sa-icon.sa-success {
    border-color: transparent \9
  ;
  }

  .sa-icon.sa-success .sa-line.sa-tip {
    -ms-transform: rotate(45deg) \9
  ;
  }

  .sa-icon.sa-success .sa-line.sa-long {
    -ms-transform: rotate(-45deg) \9
  ;
  }

  .animateSuccessTip {
    -webkit-animation: animateSuccessTip 0.75s;
    animation: animateSuccessTip 0.75s;
  }

  .animateSuccessLong {
    -webkit-animation: animateSuccessLong 0.75s;
    animation: animateSuccessLong 0.75s;
  }

  @-webkit-keyframes animateSuccessLong {
    0% {
      width: 0;
      right: 46px;
      top: 54px;
    }
    65% {
      width: 0;
      right: 46px;
      top: 54px;
    }
    84% {
      width: 55px;
      right: 0px;
      top: 35px;
    }
    100% {
      width: 47px;
      right: 8px;
      top: 38px;
    }
  }

  @-webkit-keyframes animateSuccessTip {
    0% {
      width: 0;
      left: 1px;
      top: 19px;
    }
    54% {
      width: 0;
      left: 1px;
      top: 19px;
    }
    70% {
      width: 50px;
      left: -8px;
      top: 37px;
    }
    84% {
      width: 17px;
      left: 21px;
      top: 48px;
    }
    100% {
      width: 25px;
      left: 14px;
      top: 45px;
    }
  }

  @keyframes animateSuccessTip {
    0% {
      width: 0;
      left: 1px;
      top: 19px;
    }
    54% {
      width: 0;
      left: 1px;
      top: 19px;
    }
    70% {
      width: 50px;
      left: -8px;
      top: 37px;
    }
    84% {
      width: 17px;
      left: 21px;
      top: 48px;
    }
    100% {
      width: 25px;
      left: 14px;
      top: 45px;
    }
  }

  @keyframes animateSuccessLong {
    0% {
      width: 0;
      right: 46px;
      top: 54px;
    }
    65% {
      width: 0;
      right: 46px;
      top: 54px;
    }
    84% {
      width: 55px;
      right: 0px;
      top: 35px;
    }
    100% {
      width: 47px;
      right: 8px;
      top: 38px;
    }
  }

  .sa-icon.sa-success .sa-line {
    height: 5px;
    background-color: #4CAF50;
    display: block;
    border-radius: 2px;
    position: absolute;
    z-index: 2;
  }

  .sa-icon.sa-success .sa-line.sa-tip {
    width: 25px;
    left: 14px;
    top: 46px;
    -webkit-transform: rotate(45deg);
    transform: rotate(45deg);
  }

  .sa-icon.sa-success .sa-line.sa-long {
    width: 47px;
    right: 8px;
    top: 38px;
    -webkit-transform: rotate(-45deg);
    transform: rotate(-45deg);
  }

  @-webkit-keyframes rotatePlaceholder {
    0% {
      transform: rotate(-45deg);
      -webkit-transform: rotate(-45deg);
    }
    5% {
      transform: rotate(-45deg);
      -webkit-transform: rotate(-45deg);
    }
    12% {
      transform: rotate(-405deg);
      -webkit-transform: rotate(-405deg);
    }
    100% {
      transform: rotate(-405deg);
      -webkit-transform: rotate(-405deg);
    }
  }

  @keyframes rotatePlaceholder {
    0% {
      transform: rotate(-45deg);
      -webkit-transform: rotate(-45deg);
    }
    5% {
      transform: rotate(-45deg);
      -webkit-transform: rotate(-45deg);
    }
    12% {
      transform: rotate(-405deg);
      -webkit-transform: rotate(-405deg);
    }
    100% {
      transform: rotate(-405deg);
      -webkit-transform: rotate(-405deg);
    }
  }

  .wait {
    background-image: repeating-linear-gradient(
            -45deg,
            #3ba188,
            #3ba188 11px,
            lighten(#3ba188, 10%) 10px,
            lighten(#3ba188, 10%) 20px /* determines size */
    );
    cursor: default;
    background-size: 85px 85px;
    animation: move 2s linear infinite;
  }

  @keyframes move {
    0% {
      background-position: 0 0;
    }
    100% {
      background-position: 85px 0;
    }
  }

  .modal_wrapper {
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    background-color: rgba(#000, .5);
    overflow: hidden;
    z-index: 9999;
    cursor: pointer;
    padding: 240px 0;
  }

  .modal_container {
    position: relative;
    margin-bottom: 0;
    cursor: default;
  }

  .modal_header {
    display: flex;
    width: 100%;
    padding: 15px 15px;
    justify-content: space-between;
    border-bottom: 1px solid #e8eef5;
    h2 {
      padding: 0;
      margin: 0;
      font-size: 18px;
    }
    .btn {
      display: flex;
      align-items: center;
      &-cancel {
        background: none;
        padding: 0;
        margin: 0;
        color: #cccccc;
        outline: none;
        &:hover {
          color: #333333;
        }
      }
    }
  }

  .modal_body {
    display: flex;
    width: 100%;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding-top: 20px;
    padding-bottom: 30px;
    &_wrapper {
      width: 100%;
      display: flex;
      justify-content: center;
      flex-direction: column;
      align-items: center;
    }
    .form-group {
      width: 65%;
      margin-bottom: 20px;
    }
    .field {
      width: 100%;
      border-radius: 3px;
      border: 1px solid #e8eef5;
      padding: 15px;
      background-color: transparent;
      color: #4a4c63;
      font-size: 16px;
      font-weight: 400;
      line-height: 20px;
      letter-spacing: 0.4px;
      transition: .3s;
      position: relative;
      &::placeholder {
        color: #6c757d;
      }
      &:focus {
        border: 1px solid #4a4c63;
      }
    }
  }

  .fade-enter-active, .fade-leave-active {
    transition: opacity .3s;
  }

  .fade-enter, .fade-leave-to /* .fade-leave-active до версии 2.1.8 */
  {
    opacity: 0;
  }

</style>