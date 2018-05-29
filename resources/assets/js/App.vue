<template>
  <div>
    <transition name="fade">
      <app-header v-if="!isIndex"></app-header>
    </transition>
    <transition name="fade">
      <router-view/>
    </transition>
    <!--<right-panel-friends v-if="!isIndex"/>-->
    <add-chanel-telegram/>
  </div>
</template>

<script>
import AppHeader from './components/Authorized/Header'
import RightPanelFriends from './components/Shared/parts/RightPanelFriends'
import AddChanelTelegram from './components/Shared/parts/Modal/AddChanelTelegram'


export default {
  name : "App",
  components : {
    AppHeader,
    RightPanelFriends,
    AddChanelTelegram
  },
  methods: {
    scroll () {
      let header = document.querySelector('header')
      document.onscroll = ( event ) => {
        let wrapper = event.target;
        let scrollTop = wrapper.documentElement.scrollTop,
          wrapperWidth = wrapper.documentElement.clientWidth
        if ( scrollTop-70 > header.clientHeight && wrapperWidth > 978  ) {
          header.style.top = '-100%'
        }else if(scrollTop-70<=header.clientHeight ) {
          header.style.top = '0'
        }
      }
      document.onmousemove = ( event ) => {
        if(event.clientY-30<=header.clientHeight){
          header.style.top = '0'
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
  mounted(){
    this.scroll ();
  },
  computed : {
    isIndex () {
      return this.$route.name === 'index' ? true : false
    }
  }
}
</script>

<style scoped>
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

</style>