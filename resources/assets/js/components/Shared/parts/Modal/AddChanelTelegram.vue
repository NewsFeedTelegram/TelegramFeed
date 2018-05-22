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
                <div class="form-group">
                  <input type="text" class="field" placeholder="Chanel link">
                </div>
                <button class="btn btn-green">Add Chanel</button>
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
  computed: {
    open(){
      return this.$store.getters.modalAddChanelTelegram.open
    }
  },
  methods: {
    closeModal(){
      this.$store.commit('TOGGLE_MODAL_TELEGRAM')
    }
  }
}
</script>

<style scoped lang="scss">
  .modal_wrapper {
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    background-color: rgba(#000, .5);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    cursor: pointer;
  }

  .modal_container {
    position: relative;
    margin-bottom: 0;
    cursor: default;
  }
  .modal_header{
    display: flex;
    width: 100%;
    padding: 15px 15px;
    justify-content: space-between;
    border-bottom: 1px solid #e8eef5;
    h2{
      padding: 0;
      margin: 0;
      font-size: 18px;
    }
    .btn{
      display: flex;
      align-items: center;
      &-cancel{
        background: none;
        padding: 0;
        margin: 0;
        color: #cccccc;
        outline: none;
        &:hover{
          color: #333333;
        }
      }
    }
  }
  .modal_body{
    display: flex;
    width: 100%;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding-top: 20px;
    padding-bottom: 30px;
    .form-group{
      width: 65%;
      margin-bottom: 20px;
    }
    .field{
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
      &::placeholder{
        color: #6c757d;
      }
      &:focus{
        border: 1px solid #4a4c63;
      }
    }
  }

  .fade-enter-active, .fade-leave-active {
    transition: opacity .3s;
  }
  .fade-enter, .fade-leave-to /* .fade-leave-active до версии 2.1.8 */ {
    opacity: 0;
  }

</style>