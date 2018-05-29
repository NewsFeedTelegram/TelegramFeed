<template>
  <section id="main-section" class="section">
    <div class="container">
      <div class="row">
        <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
          <div class="white-block">
            <div class="profile_wallpaper">
              <img src="img/wallpaper.jpg" alt="">
            </div>
            <div class="profile-section">
              <div class="row">
                <div class="col col-lg-5 col-md-5 col-sm-12 col-12">
                  <ul class="profile-menu">
                    <li>
                      <a href="#" class="active">Timeline</a>
                    </li>
                    <li>
                      <a href="#">About</a>
                    </li>
                    <li>
                      <a href="#l">Friends</a>
                    </li>
                  </ul>
                </div>
                <div class="col col-lg-5 ml-auto col-md-5 col-sm-12 col-12">
                  <ul class="profile-menu">
                    <li>
                      <a href="#">Photos</a>
                    </li>
                    <li>
                      <a href="#">Videos</a>
                    </li>
                    <li>
                      <a href="#">Videos</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="top-header-author">
              <a href="#" class="author-thumb">
                <img src="img/180.jpg" alt="author">
              </a>
              <div class="author-content">
                <a href="#" class="h4 author-name">{{ userFullName }}</a>
                <div class="country">Mykolaiv, UA</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
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
        </aside>
      </div>
    </div>
  </section>
</template>

<script>
import AppPost from '../Shared/parts/Post'

export default {
  name : "Profile",
  data () {
    return {
      load : false,
      list : 10
    }
  },
  components : {
    AppPost
  },
  computed: {
    userFullName () {
      return `${this.$store.getters.user.first_name} ${this.$store.getters.user.last_name}`
    },
    listPost () {
      return this.$store.getters.listPost
    }
  },
  methods : {
    // scroll () {
    //   window.onscroll = ( event ) => {
    //     let wrapper = event.target,
    //       list = wrapper.firstElementChild;
    //     let scrollTop = wrapper.documentElement.scrollTop,
    //       wrapperHeight = wrapper.documentElement.clientHeight,
    //       listHeight = list.offsetHeight
    //     let diffHeight = listHeight - wrapperHeight
    //     // console.log ( diffHeight , scrollTop+500)
    //     if ( diffHeight <= scrollTop + 300 && !this.load ) {
    //       this.load = true
    //       this.list += 10
    //       console.log ( diffHeight, scrollTop )
    //       setTimeout ( () => {
    //         this.load = false
    //       }, 500 )
    //     }
    //   }
    // }
  },
  mounted () {
    // this.$store.dispatch ( 'USER_PROFILE' )
    // setTimeout ( () => {
    //   document: document.documentElement.scrollTop = 0
    //   this.scroll ();
    // }, 300 )

  }
}
</script>

<style scoped lang="scss">
  .top-header-author {
    position: absolute;
    left: 50%;
    -webkit-transform: translate(-50%,0);
    transform: translate(-50%,0);
    bottom: 30px;
    text-align: center;
    max-width: 200px;
    z-index: 4;
  }
  .country{
    font-size: 12px;
    color: #888da8;
  }
  .profile-menu li a, .profile-menu li>div {
    font-size: 14px;
    font-weight: 700;
    color: #9a9fbf;
    display: block;
    text-decoration: none;
  }
  .top-header-author .author-name {
    font-weight: 700;
    color: #515365;
    font-size: 22px;
    text-decoration: none;
  }
  .top-header-author .author-thumb {
    border-radius: 100%;
    border: 6px solid #fff;
    margin: 0 auto;
    overflow: hidden;
    width: 132px;
    height: 132px;
    background-color: #FDFBEE;
    display: block;
  }
  .top-header-author .author-thumb img {
    border-radius: 0;
    object-fit: cover;
    width: 100%;
    height: 100%;
  }
  .profile_wallpaper {
    width: 100%;
    height: 425px;
    overflow: hidden;
    img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
  }
  .profile-menu{
    margin-bottom: 0;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-pack: distribute;
    justify-content: space-around;
    list-style: none;
    margin: 0;
    padding: 40px 0 ;
  }
  .ml-auto, .mx-auto {
    margin-left: auto!important;
  }
  .profile-menu li a.active, .profile-menu li a:hover, .profile-menu li>div.active, .profile-menu li>div:hover {
    color: #515365;
  }
</style>