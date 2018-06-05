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
                <div class="col col-lg-5 col-md-12 col-sm-12 col-12">
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
                <div class="col col-lg-5 ml-auto col-md-12 col-sm-12 col-12">
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
        <main class="col col-xl-6 order-xl-2 col-lg-8 order-lg-3 col-md-12 order-sm-2 col-sm-12 col-12 order-2">
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
        <aside-left :asideClass="'col col-xl-3 order-xl-1 col-lg-2 order-lg-1 d-xl-block col-md-12 d-none'"/>
        <aside-right :asideClass="'col col-xl-3 order-xl-3 col-lg-2 order-lg-2 d-xl-block col-md-12 d-none'"/>
        <div class="col d-lg-block col-lg-4 col-md-12  d-xl-none d-none">
          <aside-left/>
          <aside-right/>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import AppPost from '../Shared/parts/Post'
import AsideLeft from '../Shared/parts/Desktop/AsideLeft'
import AsideRight from '../Shared/parts/Desktop/AsideRight'
import VueSticky from 'vue-sticky' // Es6 module
import VueContentLoading from 'vue-content-loading';

export default {
  name : "Profile",
  data () {
    return {
      load : false,
      list : 10
    }
  },
  components : {
    AppPost,
    AsideLeft,
    AsideRight,
    VueContentLoading,

  },
  directives : {
    'sticky' : VueSticky,
  },
  watch : {
    refreshToken ( v, old ) {
      if ( v ) {
        this.loadPost ()
      }
    }
  },
  computed: {
    userFullName () {
      return `${this.$store.getters.user.first_name} ${this.$store.getters.user.last_name}`
    },
    listPosts () {
      return this.$store.getters.listPost
    },
    loadMore () {
      return this.$store.getters.loadMore
    },
    isLoadPost () {
      return this.$store.getters.loadPost
    },
    refreshToken () {
      return this.$store.getters.refreshStatus
    },
  },
  methods : {
    loadPost () {
      this.$store.dispatch ( 'LIST_CHANNEL' )
      this.$store.dispatch ( 'LIST_POST' )
    },
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
  created () {
    if ( this.refreshToken ) {
      this.loadPost ()
    }
    setTimeout ( () => {
      document.documentElement.scrollTop = 0
    }, 300 )
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
    -webkit-border-radius: 5px 5px 0 0 ;
    -moz-border-radius: 5px 5px 0 0 ;
    border-radius: 5px 5px 0 0 ;
    position: relative;
    &:after{
      content: '';
      display: block;
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      box-shadow: inset 0 -120px 55px -30px rgba(0,0,0,.5);
    }
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