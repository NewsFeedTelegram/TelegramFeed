<template>
  <div class="white-block">
    <article class="post">
      <div class="post--author">
        <div class="post--author-user">
          <img :src="post.channel.photo" :alt="post.channel.name">
          <div class="post--author-date">
            <a class="h6 post--author-name fn" href="#">{{ post.channel.name }} </a> <a :href="post.channel.link"
                                                                                        class="post--author-channel">{{
            channelLink }}</a>
            <!--<span class="share">shared-->
            <!--a <a href="#">link</a></span>-->
            <div class="post--date">
              <a :href="`${post.channel.link}/${post.message_id}/?embed=1`" class="published" target="_blank">
                <time class="published" datetime="2018-05-1T15:18">
                  {{ datePost }}
                </time>
              </a>
            </div>
          </div>
        </div>
        <div class="more">
          <svg class="icon icon-more-button">
            <use xlink:href="#icon-more-button"></use>
          </svg>
          <ul class="more-dropdown">
            <li>
              <a href="javascript:void(0)">Edit Post</a>
            </li>
            <li>
              <a href="javascript:void(0)">Delete Post</a>
            </li>
            <li>
              <a href="javascript:void(0)">Turn Off Notifications</a>
            </li>
            <li>
              <a href="javascript:void(0)">Select as Featured</a>
            </li>
          </ul>
        </div>
      </div>
      <p v-html="postMessage"></p>
      <div class="post__media" v-if="post.media.links_media">
        <img v-if="post.media.type === 1 || post.media.type === 2"
             class="post__media__img" v-for="img in post.media.links_media" :src="img" alt="">
        <video v-if="post.media.type === 3" class="post__media__video"
               v-for="video in post.media.links_media" :src="video" controls></video>
      </div>
      <div class="post__webpage" v-if="post.media.webPage">
        <a :href="post.media.webPage.url" target="_blank">
          <div>
            <div class="post__webpage__photo" v-if="post.media.webPage.type === 'photo'">
              <img :src="post.media.webPage.url" alt="">
            </div>
            <div class="post__webpage__sitename" v-if="post.media.webPage.site_name">{{ post.media.webPage.site_name }}</div>
            <div class="post__webpage__video" v-if="post.media.webPage.type === 'video'">
              <iframe width="854" height="480" :src="youTubeVideoUrl" frameborder="0"
                      allow="autoplay; encrypted-media" allowfullscreen></iframe>
            </div>
            <div class="post__webpage__title" v-if="post.media.webPage.title">{{ post.media.webPage.title }}</div>
            <div class="post__webpage__description" v-if="post.media.webPage.description">{{
              post.media.webPage.description }}
            </div>
          </div>
          <div class="post__webpage__image" v-if="post.media.webPage.photo"><img :src="post.media.webPage.photo" alt="">
          </div>
        </a>


      </div>
    </article>
  </div>
</template>

<script>
export default {
  name : "Post",
  props : [ 'post' ],
  data () {
    return {
      btnShow : false
    }

  },
  computed : {
    channelLink () {
      var a = this.post.channel.link
      a = a.replace ( /https\:\/\/t.me\//g, "@" )
      return a
    },
    youTubeVideoUrl () {
      if ( this.post.media.webPage.type === 'video' ) {
        let url = this.post.media.webPage.display_url
        url = url.replace ( /youtube.com\/watch\?v=/g, "https://www.youtube.com/embed/" )
        return url
      }
    },
    datePost () {
      // moment(this.post.data).format('MMMM DD YYYY, HH:mm')
      // a.startOf ( 'hour' ).fromNow ()

      let a = moment ( this.post.data * 1000 )
      // console.log('time: ' + a.hours())
      // console.log('date: ' + a.date())
      return a.format ( 'MMMM DD YYYY, HH:mm' )

    },
    postMessage () {
      var a = this.post.message
      a = a.replace ( /((http(s)?:\/\/)|(www\.))([^\.]+)\.([^\s]+)/g, "<a href='$&' target=\"_blank\">$&</a>" )
      return a
    }
  },
  methods : {
    show ( e ) {
      console.log ( e )
    }
  }
}
</script>

<style scoped lang="scss">

</style>