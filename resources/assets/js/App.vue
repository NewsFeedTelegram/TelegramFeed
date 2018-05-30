<template>
  <div>
    <transition name="fade">
      <app-header v-show="!isIndex"></app-header>
    </transition>
    <transition name="fade">
      <router-view/>
    </transition>
    <!--<right-panel-friends v-if="!isIndex"/>-->
    <button id="scrolltop" @click.prevent="scrollToY(0, 1500)">
      <svg class="icon icon-arrow-up">
        <use xlink:href="#icon-arrow-up"></use>
      </svg>
    </button>
    <add-chanel-telegram/>
  </div>
</template>

<script>
import AppHeader from './components/Authorized/Header'
import RightPanelFriends from './components/Shared/parts/RightPanelFriends'
import AddChanelTelegram from './components/Shared/parts/Modal/AddChanelTelegram'

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
  components : {
    AppHeader,
    RightPanelFriends,
    AddChanelTelegram
  },
  methods : {

    scrollTop () {
      document.documentElement.scrollTop = 0
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
    scroll () {
      let header = document.querySelector ( 'header' )
      let btnScrollTop = document.querySelector('#scrolltop')
      document.onscroll = ( event ) => {
        let wrapper = event.target;
        let scrollTop = window.pageYOffset || wrapper.documentElement.scrollTop,
          wrapperWidth = wrapper.documentElement.clientWidth
        if ( scrollTop - 70 > header.clientHeight) {
          btnScrollTop.style.display = 'flex'
        } else if ( scrollTop - 70 <= header.clientHeight ) {
          btnScrollTop.style.display = 'none'
        }
        if ( scrollTop - 70 > header.clientHeight && wrapperWidth > 978 ) {
          header.style.top = '-100%'
          header.style.opacity = '0'
        } else if ( scrollTop - 70 <= header.clientHeight ) {
          header.style.top = '0'
          header.style.opacity = '1'
        }
      }
      document.onmousemove = ( event ) => {
        if ( event.clientY - 30 <= header.clientHeight ) {
          header.style.top = '0'
          header.style.opacity = '1'
        }
      }
    }
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
  }
  ,
  computed : {
    isIndex () {
      return this.$route.name === 'index' ? true : false
    }
  }
}
</script>

<style scoped lang="scss">
  .fade-enter-active {
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
  }

  #scrolltop {
    position: fixed;
    bottom: 30px;
    right: 30px;
    display: none;
    font-size: 28px;
    color: #50bfa4;
    background: transparent;
    border: none;
    outline: none;
    cursor: pointer;
    transition: .3s;
    &:hover{
      font-size: 32px;
      color: darken(#50bfa4, 10%);
    }
  }

</style>