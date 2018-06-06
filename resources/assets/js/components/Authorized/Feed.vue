<template>
  <section id="main-section" class="section">
    <div class="container">
      <div class="row">
        <main class="col col-xl-6 order-xl-2 col-lg-8 order-lg-3 col-md-12 order-sm-2 col-sm-12 col-12 order-2">
          <div class="sampleContainer" v-if="listPosts.length">
            <div class="loader">
              <span class="dot dot_1"></span>
              <span class="dot dot_2"></span>
              <span class="dot dot_3"></span>
              <span class="dot dot_4"></span>
            </div>
          </div>
          <div class="newsfeed-items-grid">
            <div class="white-block" v-for="i in list" :key="i" v-if="isLoadPost">
              <vue-content-loading :width="300" :height="100">
                <circle cx="25" cy="30" r="13"/>
                <rect x="45" y="25" rx="4" ry="4" width="100" height="8"/>
                <rect x="10" y="55" rx="4" ry="4" width="calc(100% - 20px)" height="8"/>
                <rect x="10" y="70" rx="4" ry="4" width="calc(100% - 20px)" height="8"/>
                <rect x="10" y="85" rx="4" ry="4" width="calc(100% - 20px)" height="8"/>
              </vue-content-loading>
            </div>
            <app-post v-for="(index, post) in listPosts" :key="post.id" :post="index" v-if="!isLoadPost"></app-post>

            <div class="loader" v-if="loadMore">
              <div class="ball-loader">
                <div class="ball-loader-ball ball1"></div>
                <div class="ball-loader-ball ball2"></div>
                <div class="ball-loader-ball ball3"></div>
              </div>
            </div>
          </div>
        </main>
        <aside-left :asideClass="'col col-xl-3 order-xl-1 col-lg-2 order-lg-1 d-xl-block col-md-12 d-none'"/>
        <aside-right :asideClass="'col col-xl-3 order-xl-3 col-lg-2 order-lg-2 d-xl-block col-md-12 d-none'"/>
        <div class="col d-lg-block col-lg-4 col-md-12  d-xl-none d-none">
          <div v-sticky="{ zIndex: 15, stickyTop: 15, disabled: false}">
            <aside-left/>
            <aside-right/>
          </div>
        </div>
      </div>
    </div>
    <photo-gallery v-if="galleryPhoto.open" :url="galleryPhoto.url"/>
  </section>
</template>

<script>
import AppPost from '../Shared/parts/Post'
import VueContentLoading from 'vue-content-loading';
import PhotoGallery from '../Shared/parts/Modal/GalleryPhoto'
import AsideLeft from '../Shared/parts/Desktop/AsideLeft'
import AsideRight from '../Shared/parts/Desktop/AsideRight'
import VueSticky from 'vue-sticky' // Es6 module

export default {
  name : "Test",
  data () {
    return {
      list : 10,
      load : false,
    }
  },
  directives : {
    'sticky' : VueSticky,
  },
  watch : {
    refreshToken ( v, old ) {
      if ( v ) {
        this.loadPost ()
      }
    }
  },
  computed : {
    user () {
      return this.$store.getters.user
    },
    swipeMenu () {
      return this.$store.getters.swipeMenu
    },
    galleryPhoto () {
      return this.$store.getters.galleryPhoto
    },
    listChannel () {
      return this.$store.getters.listChannel
    },
    loadMore () {
      return this.$store.getters.loadMore
    },
    listPosts () {
      return this.$store.getters.listPost
    },
    refreshToken () {
      return this.$store.getters.refreshStatus
    },
    isLoadPost () {
      return this.$store.getters.loadPost
    }
  },
  methods : {
    openTelegramModal () {
      this.$store.commit ( 'TOGGLE_MODAL_TELEGRAM' )
    },
    reload () {
      let main = document.querySelector ( 'main' )
      main.onmousedown = e => {
        let top = 0
        let currentY = e.clientY
        main.style.paddingTop = 0 + 'px'
        main.style.transition = '.2s'
        var selected_text = window.getSelection () || document.selection.createRange ().text;
        if ( !this.isLoadPost ) {
          window.onmousemove = function ( ev ) {
            if ( selected_text.type !== 'Range' ) {
              // window.getSelection().removeAllRanges();
              if ( currentY < ev.clientY && document.documentElement.scrollTop === 0 ) {
                window.getSelection ().removeAllRanges ();
                top += 10
                if ( top <= 60 ) {
                  main.style.paddingTop = top + 'px'
                }
                if ( top > 60 ) {
                  top = 60
                }
                currentY = ev.clientY
              } else if ( currentY > ev.clientY && document.documentElement.scrollTop === 0 ) {
                top -= 10
                if ( top >= 0 ) {
                  main.style.paddingTop = top + 'px'
                }
                currentY = ev.clientY
              }
            }
          }

        }

        main.ondragstart = function () {
          return false;
        };
        window.onmouseup = () => {
          if ( top >= 60 ) {
            this.loadPost ()
          }
          main.onselectstart = null
          document.onselectstart = null
          window.onmousemove = null;
          main.style.paddingTop = '0'
          main.style.cursor = ''
        }
      }
    },
    deletePost ( e ) {
      this.$store.dispatch ( 'DELETE_CHANNEL', e )
    },
    loadPost () {
      this.$store.dispatch ( 'LIST_CHANNEL' )
      this.$store.dispatch ( 'LIST_POST' )
    },
    scroll () {
      window.onscroll = ( event ) => {
        let wrapper = event.target,
          list = wrapper.firstElementChild || wrapper.firstChild;
        let scrollTop = window.pageYOffset || wrapper.documentElement.scrollTop,
          wrapperHeight = wrapper.documentElement.clientHeight,
          listHeight = list.offsetHeight || list.parentNode.documentElement.offsetHeight
        let diffHeight = listHeight - wrapperHeight
        if ( diffHeight <= scrollTop + 1000 && !this.loadMore && !this.isLoadPost ) {
          this.$store.dispatch ( 'LOAD_MORE_POST' )
        }
      }
    }
  },
  components : {
    AppPost,
    VueContentLoading,
    PhotoGallery,
    AsideLeft,
    AsideRight
  },
  created () {
    if ( this.refreshToken ) {
      this.loadPost ()
    }
    setTimeout ( () => {
      document.documentElement.scrollTop = 0
      this.scroll ();
    }, 300 )
  },
  mounted () {
    this.reload ()
  }
}
</script>

<style scoped lang="scss">
  .newsfeed-items-grid {
    position: relative;
    z-index: 1;
  }

  $animationLength: 1.5s;
  $animationRadius: 12px;
  $dotSize: 8px;

  .sampleContainer {
    position: absolute;
    top: 15px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 0;
  }

  .loader {
    position: relative;
    width: $animationRadius * 3 + $dotSize;
    height: $dotSize;
    margin: $animationRadius auto;
  }

  .dot {
    display: inline-block;
    width: $dotSize;
    height: $dotSize;
    border-radius: $dotSize * 0.5;
    background: #ccc;
    position: absolute;
  }

  .dot_1 {
    animation: animateDot1 $animationLength linear infinite;
    left: $animationRadius;
    background: #50bfa4;
  }

  .dot_2 {
    animation: animateDot2 $animationLength linear infinite;
    animation-delay: $animationLength / 3;
    left: $animationRadius * 2;
  }

  .dot_3 {
    animation: animateDot3 $animationLength linear infinite;
    left: $animationRadius;
  }

  .dot_4 {
    animation: animateDot4 $animationLength linear infinite;
    animation-delay: $animationLength / 3;
    left: $animationRadius * 2;
  }

  @keyframes animateDot1 {
    0% {
      transform: rotate(0deg) translateX(-$animationRadius);
    }
    25% {
      transform: rotate(180deg) translateX(-$animationRadius);
    }
    75% {
      transform: rotate(180deg) translateX(-$animationRadius);
    }
    100% {
      transform: rotate(360deg) translateX(-$animationRadius);
    }
  }

  @keyframes animateDot2 {
    0% {
      transform: rotate(-0deg) translateX(-$animationRadius);
    }
    25% {
      transform: rotate(-180deg) translateX(-$animationRadius);
    }
    75% {
      transform: rotate(-180deg) translateX(-$animationRadius);
    }
    100% {
      transform: rotate(-360deg) translateX(-$animationRadius);
    }
  }

  @keyframes animateDot3 {
    0% {
      transform: rotate(0deg) translateX($animationRadius);
    }
    25% {
      transform: rotate(180deg) translateX($animationRadius);
    }
    75% {
      transform: rotate(180deg) translateX($animationRadius);
    }
    100% {
      transform: rotate(360deg) translateX($animationRadius);
    }
  }

  @keyframes animateDot4 {
    0% {
      transform: rotate(-0deg) translateX($animationRadius);
    }
    25% {
      transform: rotate(-180deg) translateX($animationRadius);
    }
    75% {
      transform: rotate(-180deg) translateX($animationRadius);
    }
    100% {
      transform: rotate(-360deg) translateX($animationRadius);
    }
  }

  $width: 100;
  $color: #a3a8ad;

  .ball-loader {
    width: $width + 0px;
    height: ($width / 3) - 10px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
  }

  .ball-loader-ball {
    will-change: transform;
    height: ($width / 4) - 10px;
    width: ($width / 4) - 10px;
    border-radius: 50%;
    background-color: $color;
    position: absolute;
    animation: grow .5s ease-in-out infinite alternate;

    &.ball1 {
      left: 15%;
      transform-origin: 100% 50%;
    }
    &.ball2 {
      left: 50%;
      transform: translateX(-50%) scale(1);
      animation-delay: 0.33s;
    }
    &.ball3 {
      right: 15%;
      animation-delay: 0.66s;
    }
  }

  @keyframes grow {
    to {
      transform: translateX(-50%) scale(0);
    }
  }

  .list-channel {
    height: 292px;
    li {
      transition: .3s;
      .delete {
        display: none;
        color: rgba(243, 60, 60, 0.8);;
        font-size: 13px;
        transition: .3s;
        &:hover {
          color: darken(rgba(243, 60, 60, 0.8), 10%);
        }
      }
      &:hover .delete {
        display: flex;
      }
    }
  }

  .loader {
    display: flex;
    align-self: center;
    justify-content: center;
    position: relative;
    padding-bottom: 15px;
    img {
      width: 50px;
    }
  }
</style>