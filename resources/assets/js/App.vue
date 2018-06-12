<template>
  <div class="relative"
       :class="{section_open_left: swipeMenu.leftSwipe && !isIndex && isMobile, section_open_right: swipeMenu.rightSwipe && !isIndex && isMobile }">
    <transition name="fade">
      <app-header v-show="!isIndex"></app-header>
    </transition>
    <transition name="fade">
      <router-view></router-view>
    </transition>

    <!--<right-panel-friends v-if="!isIndex"/>-->
    <button id="scrolltop" @click.prevent="scrollToY(0, 1500)" v-show="swipeMenu.leftSwipe || swipeMenu.rightSwipe">
      <svg class="icon icon-arrow-up">
        <use xlink:href="#icon-arrow-up"></use>
      </svg>
    </button>
    <app-left-menu v-if="!isIndex"/>
    <app-right-menu v-if="!isIndex"/>
    <add-chanel-telegram/>
  </div>
</template>

<script>
import AppHeader from './components/Authorized/Header'
import RightPanelFriends from './components/Shared/parts/RightPanelFriends'
import AddChanelTelegram from './components/Shared/parts/Modal/AddChanelTelegram'
import AppRightMenu from './components/Shared/parts/Responsive/AppRightMenu'
import AppLeftMenu from './components/Shared/parts/Responsive/AppLeftMenu'

window.requestAnimFrame = ( function () {
  return window.requestAnimationFrame ||
    window.webkitRequestAnimationFrame ||
    window.mozRequestAnimationFrame ||
    function ( callback ) {
      window.setTimeout ( callback, 1000 / 60 );
    };
} ) ();
export default {
  name : "App",
  methods : {
    scrollTop () {
      document.documentElement.scrollTop = 0
    },
    swipe () {
      this.$store.dispatch ( 'SWIPE_MENU' )
    },
    scrollToY ( scrollTargetY, speed, easing ) {
      let scrollY = window.scrollY || document.documentElement.scrollTop
      let scrollTarget = scrollTargetY || 0
      let speeds = speed || 2000
      let easings = easing || 'easeOutSine'
      let currentTime = 0;
      let time = Math.max ( .1, Math.min ( Math.abs ( scrollY - scrollTarget ) / speeds, .8 ) );
      let easingEquations = {
        easeOutSine : function ( pos ) {
          return Math.sin ( pos * ( Math.PI / 2 ) );
        },
        easeInOutSine : function ( pos ) {
          return ( -0.5 * ( Math.cos ( Math.PI * pos ) - 1 ) );
        },
        easeInOutQuint : function ( pos ) {
          if ( ( pos /= 0.5 ) < 1 ) {
            return 0.5 * Math.pow ( pos, 5 );
          }
          return 0.5 * ( Math.pow ( ( pos - 2 ), 5 ) + 2 );
        }
      };

      function tick () {
        currentTime += 1 / 60;

        let p = currentTime / time;
        let t = easingEquations[ easings ] ( p );

        if ( p < 1 ) {
          requestAnimFrame ( tick );

          window.scrollTo ( 0, scrollY + ( ( scrollTargetY - scrollY ) * t ) );
        } else {
          window.scrollTo ( 0, scrollTargetY );
        }
      }

      tick ();
    },
    reload () {
      document.onmousedown = e => {
        let top = 0
        let currentY = e.clientY
        document.onmousemove = function ( ev ) {

          console.log ( ev.clientY )
          console.log ( 'cur' + currentY )
          if ( currentY < ev.clientY && document.documentElement.scrollTop === 0 ) {
            top += 5
            if ( top <= 60 ) {
              document.body.style.top = top + 'px'
            }
            currentY = ev.clientY
          } else if ( currentY > ev.clientY ) {
            top -= 5
            if ( top >= 0 ) {
              document.body.style.top = top + 'px'
            }
            currentY = ev.clientY
          }
        }
        document.ondragstart = function () {
          return false;
        };
        document.onmouseup = () => {
          if ( top >= 60 ) {
            this.$store.dispatch ( 'RELOAD' )
          }
          document.onmousemove = null;
          document.body.style.top = ''
          document.body.style.cursor = ''
        }
      }
    },
    scroll () {
      let header = document.querySelector ( 'header' )
      let btnScrollTop = document.querySelector ( '#scrolltop' )
      document.onscroll = ( event ) => {
        let wrapper = event.target;
        let scrollTop = window.pageYOffset || wrapper.documentElement.scrollTop,
          wrapperWidth = wrapper.documentElement.clientWidth
        if ( scrollTop - 70 > header.clientHeight ) {
          btnScrollTop.style.display = 'flex'
        } else if ( scrollTop - 70 <= header.clientHeight ) {
          btnScrollTop.style.display = 'none'
        }
        if ( scrollTop - 70 > header.clientHeight && wrapperWidth > 978 ) {
          header.style.top = '-100%'
          header.style.opacity = '0'
        } else if ( scrollTop - 70 <= header.clientHeight ) {
          header.style.transition = '.2s'
          header.style.top = '0'
          header.style.opacity = '1'
        }
      }
      document.onmousemove = ( event ) => {
        if ( event.clientY - 30 <= header.clientHeight && !this.$store.getters.galleryPhoto.open ) {
          header.style.transition = ''
          header.style.top = '0'
          header.style.opacity = '1'
        }
      }
    }
  },
  components : {
    AppHeader,
    RightPanelFriends,
    AddChanelTelegram,
    AppRightMenu,
    AppLeftMenu
  },
// beforeMount () {
//   if ( this.$store.getters.isAuthenticated ) {
//     this.$store.dispatch ( 'REFRESH_TOKEN' )
//       .then ( () => {
//         this.$router.replace ( '' )
//       } )
//       .catch ( () => {
//         this.$store.dispatch ( 'AUTH_LOGOUT' )
//         this.$router.replace ( '/' )
//       } )
//   }
// },
  mounted () {
    document.documentElement.scrollTop = 0
    this.scroll ();
    if(document.documentElement.clientWidth <=991){
      this.swipe ()
    }
    window.addEventListener('resize', () => {
      if(document.documentElement.clientWidth <=991){
        this.swipe ()
        return true
      }else {
        window.onresize = null
      }
    })

  }
  ,
  computed : {
    isIndex () {
      return this.$route.name === 'index' ? true : false
    },
    swipeMenu () {
      return this.$store.getters.swipeMenu
    },
    isMobile(){
      return this.$store.getters.mobile
    }
  }
}
</script>

<style scoped lang="scss">


  /*  .fade-enter-active {
      transition: all .5s ease-out;
      right: 0;
      left: 0;
      z-index: 0;
    }

    .fade-leave-active {
      transition: all .5s ease-in;
      position: absolute;
      left: -100%;
      z-index: 0;
    }

    .fade-enter, .fade-leave-to {
      opacity: 0;
    }

    .fade-enter {
      left: -100%;
      opacity: 1;
    }*/

  .fade-enter-active, .fade-leave-active {
    transition: opacity .3s;
  }

  .fade-enter, .fade-leave-to /* .fade-leave-active до версии 2.1.8 */
  {
    opacity: 0;
  }

  #scrolltop {
    position: fixed;
    bottom: 15px;
    right: 0;
    display: none;
    font-size: 28px;
    color: #50bfa4;
    background: transparent;
    border: none;
    outline: none;
    cursor: pointer;
    transition: .3s;
    z-index: 8000;
    padding: 15px;
    /*&:hover{*/
    /*font-size: 32px;*/
    /*color: darken(#50bfa4, 10%);*/
    /*}*/
  }

</style>