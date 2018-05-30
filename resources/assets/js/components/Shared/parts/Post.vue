<template>
  <div class="white-block">
    <article class="post">
      <div class="post--author">
        <div class="post--author-user">
          <img :src="post.channel.photo" :alt="post.channel.name">
          <div class="post--author-date">
            <a class="h6 post--author-name fn" href="#">{{ post.channel.name }} </a> <a :href="post.channel.link" class="post--author-channel">{{ channelLink }}</a>
            <!--<span class="share">shared-->
            <!--a <a href="#">link</a></span>-->
            <div class="post--date">
              <time class="published" datetime="2018-05-1T15:18">
                 {{ post.data | moment("MMMM Do YYYY, kk:mm")}}
              </time>
            </div>
          </div>
        </div>
        <div class="more">
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
        </div>
      </div>
      <p v-html="postMessage"></p>
      <div class="post__media">
        <img v-if="post.media.links_media.length && post.media.type === 1 || post.media.type === 2" class="post__media__img" v-for="img in post.media.links_media" :src="img" alt="">
        <video v-if="post.media.links_media.length && post.media.type === 3" class="post__media__video" v-for="video in post.media.links_media" :src="video" controls></video>
      </div>
    </article>
  </div>
</template>

<script>
export default {
  name : "Post",
  props: ['post'],
  data(){
    return{
      btnShow: false
    }

  },
  computed:{
    channelLink(){
      var a = this.post.channel.link
      a=a.replace(/https\:\/\/t.me\//g, "@")
      return a
    },
    postMessage(){
      var a = this.post.message
      a=a.replace(/((http(s)?:\/\/)|(www\.))([^\.]+)\.([^\s]+)/g, "<a href='$&' target=\"_blank\">$&</a>")
      return a
    }
  },
  methods:{
    show(e){
      console.log(e)
    }
  }
}
</script>

<style scoped lang="scss">

</style>