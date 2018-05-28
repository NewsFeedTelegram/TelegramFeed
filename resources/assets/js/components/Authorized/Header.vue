<template>
  <header id="header" class="header-page">
    <div class="header-page--logo">
      <router-link :to="'/feed'"><img src="img/logo-mini.png" alt="" class="header-page--logo-img"></router-link>
    </div>
    <div class="header-page--pagename">
      <p class="header-page--pagename-text">{{titlePage}}</p>
    </div>
    <div class="header-page-content-wrapper">
      <form class="header-page--search">
        <input type="text" class="header-page--search-input"
               placeholder="Search here people">
        <button>
          <svg class="icon icon-magnifier-tool">
            <use xlink:href="#icon-magnifier-tool"></use>
          </svg>
        </button>
      </form>
      <div class="header-page--navmenu">
        <ul class="header-page--navmenu--items">
          <li class="header-page--navmenu-item">
            <router-link :to="{name: 'newsfeed'}">
              <svg class="icon icon-newspaper">
                <use xlink:href="#icon-newspaper"></use>
              </svg>
            </router-link>
          </li>
          <li class="header-page--navmenu-item">
            <a href="#">
              <svg class="icon icon-bookmark-white">
                <use xlink:href="#icon-bookmark-white"></use>
              </svg>
            </a>
          </li>
          <li class="header-page--navmenu-item">
            <a href="#">
              <svg class="icon icon-envelope">
                <use xlink:href="#icon-envelope"></use>
              </svg>
            </a>
          </li>
          <li class="header-page--navmenu-item">
            <a href="#">
              <svg class="icon icon-alarm">
                <use xlink:href="#icon-alarm"></use>
              </svg>
            </a>
            <span class="header-page--navmenu-item-notify"></span>
          </li>
          <li class="header-page--navmenu-item">
            <a href="#">
              <svg class="icon icon-more-button">
                <use xlink:href="#icon-more-button"></use>
              </svg>
            </a>
          </li>
        </ul>
        <div class="header-page--dropdown" @click.stop="toggleDropdown" :class="{active}">
          <div class="header-page--dropdown-wrapper">
            <span class="header-page--dropdown-username">{{ userFullName ? userFullName : ''}}</span>
            <span class="header-page--dropdown-useravatar">
                            <img src="img/180.jpg" alt="">
                        </span>
            <svg class="icon icon-down-arrow">
              <use xlink:href="#icon-down-arrow"></use>
            </svg>
          </div>
          <transition name="fade">
            <ul class="header-page--dropdown-menu" v-show="active">
              <li>
                <router-link :to="{ name: 'profile', params: { id: user.id }}">Моя страница</router-link>
              </li>
              <li><a href="#">Настройки</a></li>
              <li><a href="/logout" @click.prevent="logout">Выйти</a></li>
            </ul>
          </transition>
        </div>

      </div>
    </div>
  </header>
</template>

<script>
export default {
  data () {
    return {
      active : false
    }
  },
  methods : {
    toggleDropdown () {
      this.active = !this.active
    },
    logout () {
      this.$store.dispatch ( 'AUTH_LOGOUT' )
      this.$router.replace ( '/' )
    }

  },
  computed : {
    titlePage () {
      return this.$route.meta.title
    },
    userFullName () {
      return `${this.$store.getters.user.first_name} ${this.$store.getters.user.last_name}`
    },
    user () {
      return this.$store.getters.user
    }
  },
  mounted () {
    window.addEventListener ( 'click', e => {
      if ( e.target.parentNode.classList !== 'header-page--dropdown' ) {
        this.active = false
      }
    } )
  },
}
</script>

<style scoped>
  .fade-enter-active {
    transition: all 300ms ease-out;
  }

  .fade-leave-active {
    transition: all 200ms ease-in;
    position: absolute;
    z-index: 0;
  }

  .fade-enter, .fade-leave-to {
    opacity: 0;
  }

  .fade-enter {
    -webkit-transform: scale(0.9);
    transform: scale(0.9);
  }
</style>