<template>
  <section id="main-section" class="section">
    <div class="container">
      <div class="row">
        <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 order-sm-2 col-sm-12 col-12 order-2">
          <div class="white-block new-post">
            <div class="new-post--header">
              <h3 class="new-post--header--title">
                <!--<span>-->
                <!--<svg class="icon icon-newspaper">-->
                <!--<use xlink:href="#icon-newspaper"></use>-->
                <!--</svg>-->
                <!--</span>-->
                Add new post
              </h3>
              <span class="new-post--header--more">
                            <svg class="icon icon-more-button">
                                <use xlink:href="#icon-more-button"></use>
                            </svg>
                        </span>
            </div>
            <div class="new-post--field">
              <form>
                <img src="img/bg.jpg" alt="">
                <textarea placeholder="Share what you are thinking here ..."></textarea>
                <div class="new-post--control">
                  <div class="new-post--select-files">
                    <div class="new-post--select-files--file">
                      <label>
                        <input type="file" multiply accept="image/*">
                        <svg class="icon icon-photo-camera">
                          <use xlink:href="#icon-photo-camera"></use>
                        </svg>
                      </label>
                    </div>
                    <div class="new-post--select-files--file">
                      <label>
                        <input type="file" multiply accept="video/*">
                        <svg class="icon icon-video-player">
                          <use xlink:href="#icon-video-player"></use>
                        </svg>
                      </label>
                    </div>
                    <div class="new-post--select-files--file">
                      <label>
                        <input type="file" multiply accept="audio/*">
                        <svg class="icon icon-musical-note">
                          <use xlink:href="#icon-musical-note"></use>
                        </svg>
                      </label>
                    </div>
                  </div>
                  <button class="btn btn-green">
                    Add post
                  </button>
                </div>

              </form>
            </div>
          </div>
          <div class="newsfeed-items-grid">
            <app-post v-for="post in list" :key="post"></app-post>
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
      list : [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]
    }
  },
  computed : {
    user () {
      return this.$store.getters.user
    }
  },
  methods : {
    openTelegramModal(){
      this.$store.commit('TOGGLE_MODAL_TELEGRAM')
    }
  },
  components : {
    AppPost
  },
  mounted () {
    // this.$store.dispatch ( 'USER_PROFILE' )
  }
}
</script>

<style scoped lang="scss">

</style>