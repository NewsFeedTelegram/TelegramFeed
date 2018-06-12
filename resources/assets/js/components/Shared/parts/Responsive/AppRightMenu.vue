<template>
  <div class="right__sidebar" :class="{open: swipeMenu.leftSwipe}" @click.self.prevent="hideMenu">
    <div class="wrapper white-block">
      <div>
        <div class="white-block-title">
          <h6 class="title">Add chanel</h6>
          <a href="#" class="more">
            <svg class="icon icon-more-button">
              <use xlink:href="#icon-more-button"></use>
            </svg>
          </a>
        </div>
        <ul class="widget--chanel">
          <li class="inline-items">
            <div class="sn">
              <div class="sn-thumb">
                <svg class="icon icon-telegram">
                  <use xlink:href="#icon-telegram"></use>
                </svg>
              </div>
              <div class="sn-event">
                <p>Telegram</p>
              </div>
            </div>
            <span class="notification-icon">
							<a href="#" class="btn btn-accept" @click.stop.prevent="openTelegramModal">
								<span class="icon-add without-text">
                                     <svg class="icon icon-add">
                                        <use xlink:href="#icon-add"></use>
                                    </svg>
								</span>
							</a>
						</span>
          </li>
          <li class="inline-items">
            <div class="sn">
              <div class="sn-thumb">
                <svg class="icon icon-twitter-bird-logo">
                  <use xlink:href="#icon-twitter-bird-logo"></use>
                </svg>
              </div>
              <div class="sn-event">
                <p>Twitter</p>
              </div>
            </div>
            <span class="notification-icon">
							<a href="#" class="btn btn-login">
								<span class="icon-add without-text">
                                     <!--<svg class="icon icon-login">-->
                  <!--<use xlink:href="#icon-login"></use>-->
                  <!--</svg>-->
                                    login
								</span>
							</a>
						</span>
          </li>
        </ul>
      </div>
      <div>
        <div class="white-block-title">
          <h6 class="title">Channels</h6>
          <a href="#" class="more">
            <svg class="icon icon-more-button">
              <use xlink:href="#icon-more-button"></use>
            </svg>

          </a>
        </div>
        <div v-bar class="list-channel"> <!-- el1 -->
          <div> <!-- el2 -->
            <ul class="widget--chanel" v-if="!isLoadPost">
              <li class="inline-items" v-for="(list, index) in listChannel" :key="index">
                <div class="sn">
                  <div class="sn-thumb">
                    <img :src="list.photo" :alt="list.name">
                  </div>
                  <div class="sn-event">
                    <p>{{ list.name }}</p>
                  </div>
                </div>
                <span class="notification-icon">
							   <a href="#" class="delete" @click.stop.prevent="deletePost(list.id)">
                <svg class="icon icon-cancel">
                  <use xlink:href="#icon-cancel"></use>
                </svg>
              </a>

						</span>
              </li>
            </ul>
            <ul class="widget--chanel" v-if="isLoadPost">
              <li v-for="i in 4" :key="i">
                <vue-content-loading :width="300" :height="70">
                  <circle cx="35" cy="35" r="20"/>
                  <rect x="70" y="27" rx="4" ry="4" width="100" height="15"/>
                </vue-content-loading>
              </li>
            </ul>
          </div>
          <!-- dragger will be automatically added here -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import VueContentLoading from 'vue-content-loading';
export default {
  name : "AppRightMenu",
  data(){
    return {

    }
  },
  computed: {
    swipeMenu(){
      return this.$store.getters.swipeMenu
    },
    listChannel () {
      return this.$store.getters.listChannel
    },
    isLoadPost () {
      return this.$store.getters.loadPost
    }
  },
  methods:{
    openTelegramModal () {
      this.$store.commit ( 'TOGGLE_MODAL_TELEGRAM' )
    },
    deletePost ( id ) {
      this.$store.dispatch ( 'DELETE_CHANNEL', id )
    },
    hideMenu(){
      this.$store.commit('SWIPE_MENU', {
        leftSwipe : false,
        rightSwipe : false,
        home : true
      } )
      document.body.style.overflow = ''
      document.body.style.paddingRight = ''
    }
  },
  components:{
    VueContentLoading
  }
}
</script>

<style scoped lang="scss">

</style>