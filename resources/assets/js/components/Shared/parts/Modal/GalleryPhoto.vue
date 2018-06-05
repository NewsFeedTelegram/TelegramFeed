<template>
  <transition name="fade">
    <div class="modal_wrapper" @click.self.prevent="closeModal">
      <button class="btn btn-cancel" @click.prevent="closeModal">
        <svg class="icon icon-cancel">
          <use xlink:href="#icon-cancel"></use>
        </svg>
      </button>
      <div><img :src="url" class="images" alt=""></div>
    </div>
  </transition>
</template>

<script>
export default {
  name : "GalleryPhoto",
  props : [ 'url' ],
  data () {
    return {
      isZoom : false,
      zoomStyle : {
        position : 'absolute',
        width : '100vh',
        top : '0',
        left : '0',
      }
    }
  },
  methods : {
    closeModal () {
      this.$store.commit ( 'OPEN_GALLERY', { url : '', open : false } )
      document.body.style.overflow = ''
      document.body.style.paddingRight = ''
    },
    swipe () {
      var initialPoint;
      var finalPoint;
      let self = this

      document.addEventListener ( 'touchstart', function ( event ) {
        initialPoint = event.changedTouches[ 0 ];
      }, false );
      document.addEventListener ( 'touchend', function ( event ) {
        finalPoint = event.changedTouches[ 0 ];
        var xAbs = Math.abs ( initialPoint.pageX - finalPoint.pageX );
        var yAbs = Math.abs ( initialPoint.pageY - finalPoint.pageY );
        if ( xAbs > 20 || yAbs > 20 ) {
          if ( xAbs > yAbs ) {
            if ( finalPoint.pageX < initialPoint.pageX ) {
              // alert('СВАЙП ВЛЕВО')
              /*СВАЙП ВЛЕВО*/
            }
            else {
              // alert('СВАЙП ВПРАВО')
              /*СВАЙП ВПРАВО*/
            }
          }
          else {
            if ( finalPoint.pageY < initialPoint.pageY ) {
              self.closeModal ()
              /*СВАЙП ВВЕРХ*/
            }
            else {
              // alert('СВАЙП ВНИЗ')
              /*СВАЙП ВНИЗ*/
            }
          }
        }
      }, false );
    },
  },
  computed : {
    width () {
      return document.querySelector ( '.images' ).width
    }
  },
  mounted () {
    this.swipe ()
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
    z-index: 9000;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    &:hover .btn-cancel {
      color: #ffffff;
    }
    img {
      cursor: default;
      max-width: calc(100vw - 30px);
      max-height: calc(100vh - 120px);
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

  .btn-cancel {
    position: absolute;
    top: 15px;
    right: 15px;
    background: none;
    display: flex;
    color: #cccccc;
    &:hover {
      color: #ffffff;
    }
  }

</style>