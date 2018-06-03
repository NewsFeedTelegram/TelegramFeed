<template>
  <transition name="fade">
    <div class="modal_wrapper" @click.self.prevent="closeModal">
      <button class="btn btn-cancel" @click.prevent="closeModal">
        <svg class="icon icon-cancel">
          <use xlink:href="#icon-cancel"></use>
        </svg>
      </button>
      <div><img :src="url" alt=""></div>

    </div>
  </transition>
</template>

<script>
export default {
  name : "GalleryPhoto",
  props: ['url'],
  methods : {
    closeModal () {
      this.$store.commit ( 'OPEN_GALLERY', {url: '', open: false} )
    }
  },
  computed:{
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
    height: 100vh;
    &:hover .btn-cancel{
      color: #ffffff;
    }
    img{
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      cursor: default;
      max-width: calc(100vw - 30px);
      max-height: calc(100vh - 60px);
      object-fit: contain;
    }
  }


  .fade-enter-active, .fade-leave-active {
    transition: opacity .3s;
  }

  .fade-enter, .fade-leave-to /* .fade-leave-active до версии 2.1.8 */
  {
    opacity: 0;
  }
  .btn-cancel{
    position: absolute;
    top: 15px;
    right: 15px;
    background: none;
    display: flex;
    color: #cccccc;
    &:hover{
      color: #ffffff;
    }
  }

</style>