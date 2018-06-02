<template>
  <section id="main-section" class="section">
    <div class="container">
      <div class="row">
        <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-3 col-md-12 order-sm-2 col-sm-12 col-12 order-2">
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
        <aside class="col col-xl-3 order-xl-1 col-lg-6 order-lg-1 col-md-12 order-sm-3 col-sm-12 col-12 order-3" >
          <div class="white-block" v-sticky="{ zIndex: 5, stickyTop: 15, disabled: false}">
            <div >
              <div class="white-block-title">
                <h6 class="title">Add chanel</h6>
                <a href="#" class="more">
                  <svg class="icon icon-more-button">
                    <use xlink:href="#icon-more-button"></use>
                  </svg>
                </a>
              </div>
            </div>
          </div>
        </aside>
        <aside class="col col-xl-3 order-xl-3 col-lg-6 order-lg-2 col-md-12 order-sm-1 col-sm-12 col-12 order-1">
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
        </aside>
      </div>
    </div>
  </section>
</template>

<script>
import AppPost from '../Shared/parts/Post'
import VueContentLoading from 'vue-content-loading';
import VueSticky from 'vue-sticky' // Es6 module

export default {
  name : "Test",
  data () {
    return {
      list : 10,
      load : false,
    }
  },
  directives: {
    'sticky': VueSticky,
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
    deletePost ( e ) {
      console.log ( e )
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
    VueContentLoading
  },
  created () {
    if ( this.refreshToken ) {
      this.loadPost ()
    }
    setTimeout ( () => {
      document.documentElement.scrollTop = 0
      this.scroll ();
    }, 300 )
  }
}
</script>

<style scoped lang="scss">
  $width: 100;
  $color: #a3a8ad;

  .ball-loader{
    width: $width + 0px;
    height: ($width / 3) - 10px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
  }
  .ball-loader-ball{
    will-change: transform;
    height:($width / 4) - 10px;
    width: ($width / 4) - 10px;
    border-radius: 50%;
    background-color: $color;
    position: absolute;
    animation: grow .5s ease-in-out infinite alternate;


    &.ball1{
      left:15%;
      transform-origin: 100% 50%;
    }
    &.ball2{
      left:50%;
      transform: translateX(-50%) scale(1);
      animation-delay: 0.33s;
    }
    &.ball3{
      right:15%;
      animation-delay: 0.66s;
    }
  }

  @keyframes grow{
    to{
      transform: translateX(-50%) scale(0);
    }
  }

  .list-channel {
    height: 292px;
    li{
      transition: .3s;
      .delete{
        display: none;
        color: rgba(243, 60, 60, 0.8);;
        font-size: 13px;
        transition: .3s;
        &:hover{
          color: darken(rgba(243, 60, 60, 0.8), 10%);
        }
      }
      &:hover .delete{
        display: flex;
      }
    }
  }

  .loader {
    display: flex;
    align-self: center;
    justify-content: center;
    position: relative;
    padding: 15px 0;
    img {
      width: 50px;
    }
  }
</style>