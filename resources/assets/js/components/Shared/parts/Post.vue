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
      <p v-if="post.media.type === 8"> Здесь должн быть аудиофайл, но её пока нет!:( {{ post.media.preview_doc.name }}</p>
      <div class="post__media" v-if="post.media.links_media">
        <div class="post__media__album" v-if="linkMediaPhoto || linkMediaVideo">
          <img class="post__media__img" v-for="img in linkMediaPhoto" :src="img.url" alt="" @click="openPhoto(img.url)">
          <video class="post__media__album__video"
                 v-for="video in linkMediaVideo" :src="video.url" controls></video>
        </div>
        <img v-if="post.media.type === 1 || post.media.type === 8"
             class="post__media__img" v-for="img in post.media.links_media" :src="img.url" alt=""
             @click="openPhoto(img.url)">
        <video v-if="post.media.type === 3" class="post__media__video"
               v-for="video in post.media.links_media" :src="video.url" controls></video>
      </div>
      <div class="post__webpage" v-if="post.media.webPage">
        <a :href="post.media.webPage.url" target="_blank">
          <div style="width: 100%">
            <div class="post__webpage__photo" v-if="post.media.webPage.type === 'photo'">
              <img :src="post.media.webPage.url" alt="">
            </div>
            <div class="post__webpage__sitename" v-if="post.media.webPage.site_name">
              {{ post.media.webPage.site_name }}
            </div>
            <div class="post__webpage__video" v-if="post.media.webPage.type === 'video' || post.media.webPage.type === 'gif'">
              <iframe :src="youTubeVideoUrl ? youTubeVideoUrl : coubVideoUrl" width="100%" height="100%" frameborder="0" webkitallowfullscreen=""
                      mozallowfullscreen="" allowfullscreen=""></iframe>
            </div>
            <div class="post__webpage__title" v-if="post.media.webPage.title">{{ post.media.webPage.title }}</div>
            <div class="post__webpage__description" v-if="post.media.webPage.description">
              {{ post.media.webPage.description }}
            </div>
          </div>
          <div class="post__webpage__image" v-if="post.media.webPage.photo">
            <img :src="post.media.webPage.photo" alt="">
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
    linkMediaPhoto () {
      if ( this.post.media.type === 2 ) {
        let linkMedia = this.post.media.links_media
        return linkMedia.filter(x => x.format === 'photo')
      }
    },
    linkMediaVideo () {
      if ( this.post.media.type === 2 ) {
        let linkMedia = this.post.media.links_media
        return linkMedia.filter(x => x.format === 'video')
        // https://coub.com/embed/18jxf0
      }
    },
    channelLink () {
      var link = this.post.channel.link
      link = link.replace ( /https\:\/\/t.me\//g, "@" )
      return link
    },
    youTubeVideoUrl () {
      if ( this.post.media.webPage.type === 'video' ) {
        let url = this.post.media.webPage.display_url
        url = url.match ( /youtube.com\/watch\?v=/g ) ? url.replace ( /youtube.com\/watch\?v=/g, "https://www.youtube.com/embed/" ) : this.post.media.webPage.url + '?embedded=true'
        return url
      }
    },
    coubVideoUrl () {
      if ( this.post.media.webPage.type === 'gif' ) {
        let url = this.post.media.webPage.display_url
        url = url.replace ( /coub.com\/view/g , "https://coub.com/embed/" )
        return url
      }
    },
    datePost () {
      let date = moment ( this.post.data * 1000 )
      return date.format ( 'MMMM DD YYYY, HH:mm' )
    },
    postMessage () {
      var message = this.post.message
      message = message.replace ( /((http(s)?:\/\/)|(www\.))([^\.]+)\.([^\s]+)/g, "<a href='$&' target=\"_blank\">$&</a>" )
      return message
    }
  },
  methods : {
    show ( e ) {
      console.log ( e )
    },
    openPhoto ( url ) {
// создадим элемент с прокруткой
      var div = document.createElement ( 'div' );

      div.style.overflowY = 'scroll';
      div.style.width = '50px';
      div.style.height = '50px';
      div.style.visibility = 'hidden';

      document.body.appendChild ( div );
      var scrollWidth = div.offsetWidth - div.clientWidth;
      document.body.removeChild ( div );

      // body.style.visibility = 'hidden';
      this.$store.commit ( 'OPEN_GALLERY', { url : url, open : true } )
      document.body.style.overflow = 'hidden'
      document.body.style.paddingRight = `${scrollWidth}px`

    }
  }
}
</script>

<style scoped lang="scss">

</style>