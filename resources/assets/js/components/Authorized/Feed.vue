<template>
  <section id="main-section" class="section">
    <div class="container">
      <div class="row">
        <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 order-sm-2 col-sm-12 col-12 order-2">
          <div class="newsfeed-items-grid">
            <app-post v-for="post in listPost" :key="post.id" :post="post"></app-post>
          </div>
        </main>
        <aside class="col col-xl-3 order-xl-1 col-lg-6 order-lg-2 col-md-12 order-sm-3 col-sm-12 col-12 order-3">
          <div class="white-block">
            <div class="white-block-title">
              <h6 class="title">Add chanel</h6>
              <a href="#" class="more">
                <svg class="icon icon-more-button">
                  <use xlink:href="#icon-more-button"></use>
                </svg>
              </a>
            </div>
          </div>
        </aside>
        <aside class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-12 order-sm-1 col-sm-12 col-12 order-1">
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
              <h6 class="title">Channel</h6>
              <a href="#" class="more">
                <svg class="icon icon-more-button">
                  <use xlink:href="#icon-more-button"></use>
                </svg>
                <ul class="more-dropdown">
                  <li>
                    <a href="#">Edit Post</a>
                  </li>
                  <li>
                    <a href="#">Delete Post</a>
                  </li>
                  <li>
                    <a href="#">Turn Off Notifications</a>
                  </li>
                  <li>
                    <a href="#">Select as Featured</a>
                  </li>
                </ul>

              </a>
            </div>
            <ul class="widget--chanel">
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
							   <a href="#" class="more">
                <svg class="icon icon-more-button">
                  <use xlink:href="#icon-more-button"></use>
                </svg>
              </a>

						</span>
              </li>
            </ul>
          </div>
        </aside>
      </div>
    </div>
  </section>
</template>

<script>
import AppPost from '../Shared/parts/Post'

export default {
  name : "Test",
  data () {
    return {
      list : 10
    }
  },
  computed : {
    user () {
      return this.$store.getters.user
    },
    listChannel () {
      return this.$store.getters.listChannel
    },
    listPost () {
      return this.$store.getters.listPost
    }
  },
  methods : {
    openTelegramModal () {
      this.$store.commit ( 'TOGGLE_MODAL_TELEGRAM' )
    }
  },
  components : {
    AppPost
  },
  created () {
    this.$store.dispatch ( 'LIST_CHANNEL' )
    this.$store.dispatch('LIST_POST')
  }
}
</script>

<style scoped lang="scss">
.sn-thumb{
  img{
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
}
</style>