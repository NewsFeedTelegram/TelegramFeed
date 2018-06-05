<template>
  <div class="left__sidebar" :class="{open_left: swipeMenu.rightSwipe}" @click.self.prevent="hideMenu">
    <div class="wrapper white-block">
      <div>
        <div class="list-channel">
          <div> <!-- el2 -->
            <div class="user_block">
              <div class="user_block_wallpaper"></div>
              <div class="user_block_top-header-author">
                <a href="#" class="author-thumb">
                  <img src="img/180.jpg" alt="author">
                </a>
                <div class="author-content">
                  <a href="#" class="h4 author-name">{{ userFullName }}</a>
                </div>
              </div>
            </div>
            <ul class="left__sidebar__menu">
              <li class="inline-items">
                <router-link :to="{ name: 'profile', params: { id: 1 }}">
                  <svg class="icon icon-user">
                    <use xlink:href="#icon-user"></use>
                  </svg>
                  <span>Профиль</span>
                </router-link>
              </li>
              <li class="inline-items">
                <router-link :to="{name: 'newsfeed'}">
                  <svg class="icon icon-newspaper">
                    <use xlink:href="#icon-newspaper"></use>
                  </svg>
                  <span>Новости</span>
                </router-link>
              </li>
              <li class="inline-items"><a href="" class="">
                <svg class="icon icon-two-users">
                  <use xlink:href="#icon-two-users"></use>
                </svg>
                <span>Друзья</span>
              </a></li>
              <li class="inline-items"><a href="">
                <svg class="icon icon-settings">
                  <use xlink:href="#icon-settings"></use>
                </svg>
                <span>Настройки</span>
              </a></li>
              <li class="inline-items"><a href="/logout" @click.prevent="logout">
                <svg class="icon icon-logout">
                  <use xlink:href="#icon-logout"></use>
                </svg>
                <span>Выйти</span>
              </a></li>
            </ul>
          </div>
          <!-- dragger will be automatically added here -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name : "AppLeftMenu",
  computed : {
    swipeMenu () {
      return this.$store.getters.swipeMenu
    },
    userFullName () {
      return `${this.$store.getters.user.first_name} ${this.$store.getters.user.last_name}`
    },
  },
  methods : {
    logout () {
      this.$store.dispatch ( 'AUTH_LOGOUT' )
      this.$router.replace ( '/' )
    },
    hideMenu () {
      this.$store.commit ( 'SWIPE_MENU', {
        leftSwipe : false,
        rightSwipe : false,
        home : true
      } )
      document.body.style.overflow = ''
      document.body.style.paddingRight = ''
    }
  },
}
</script>

<style scoped>

</style>