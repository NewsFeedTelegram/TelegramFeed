<template>
  <aside :class="[asideClass]">
    <div v-sticky="{ zIndex: 5, stickyTop: 15, disabled: false}">
      <div>
        <div class="white-block">
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
        <div class="white-block">
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
              <ul class="widget--chanel--list" v-if="!isLoadPost">
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
                <li class="inline-items-preload" v-for="i in 4" :key="i">
                  <vue-content-loading :width="300" :height="64">
                    <circle cx="35" cy="35" r="20"/>
                    <rect x="70" y="27" rx="4" ry="4" width="70%" height="15"/>
                  </vue-content-loading>
                </li>
              </ul>
              <p v-if="!listChannel.length">Empty</p>
            </div>
            <!-- dragger will be automatically added here -->
          </div>
        </div>
      </div>
    </div>
  </aside>
</template>

<script>
import VueContentLoading from 'vue-content-loading';
import VueSticky from 'vue-sticky' // Es6 module


export default {
  name : "AsideRight",
  props : {
    asideClass : {
      type : String
    }
  },
  directives : {
    'sticky' : VueSticky,
  },
  computed : {
    listChannel () {
      return this.$store.getters.listChannel
    },
    isLoadPost () {
      return this.$store.getters.loadPost
    }
  },
  methods : {
    openTelegramModal () {
      this.$store.commit ( 'TOGGLE_MODAL_TELEGRAM' )
    },
    coords ( el ) {
      console.log ( el.getBoundingClientRect () )
      window.onscroll = ( event ) => {
        let wrapper = event.target
        let scrollTop = window.pageYOffset || wrapper.documentElement.scrollTop
        if ( scrollTop > 90 ) {
          el.style.position = 'relative'
          el.style.top = scrollTop + 90 + 'px'
        }

      }
    },
    deletePost ( id ) {
      this.$store.dispatch ( 'DELETE_CHANNEL', id )
    },
  },
  components : {
    VueContentLoading
  },
}
</script>

<style scoped>

</style>