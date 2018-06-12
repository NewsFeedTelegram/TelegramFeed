<template>
  <div class="white-block" v-cloak>
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
      <p v-if="post.media.type === 8"> Здесь должн быть аудиофайл, но её пока нет!:( {{ post.media.preview_doc.name
        }}</p>
      <div class="post__media " v-if="post.media.links_media" v-cloak>
        <div id="collage" class="post__media__album clearfix" v-if="linkMediaPhoto || linkMediaVideo">
          <img class="" v-for="img in linkMediaPhoto" :src="img.url" alt="" @click="openPhoto(img.url)">
          <div class="video" v-for="video in linkMediaVideo" >
            <video class=""
                   :src="video.url" controls></video>
          </div>
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
            <div class="post__webpage__video"
                 v-if="post.media.webPage.type === 'video' || post.media.webPage.type === 'gif'">
              <iframe :src="youTubeVideoUrl ? youTubeVideoUrl : coubVideoUrl" width="100%" height="100%" frameborder="0"
                      webkitallowfullscreen=""
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
      btnShow : false,
      mediaLoad : {
        images: false,
        video: false
      },

    }

  },
  watch:{
    mediaLoad(v){
      console.log(v)
      if(v.images && v.video){
        this.collage()
      }else if(v.images  || v.video){
        this.collage()
      }
    }
  },
  computed : {
    linkMediaPhoto () {
      if ( this.post.media.type === 2 ) {
        let linkMedia = this.post.media.links_media
        return linkMedia.filter ( x => x.format === 'photo' )
      }
    },
    linkMediaVideo () {
      if ( this.post.media.type === 2 ) {
        let linkMedia = this.post.media.links_media
        return linkMedia.filter ( x => x.format === 'video' )
        // https://coub.com/embed/18jxf0
      }
    },
    channelLink () {
      let link = this.post.channel.link
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
        url = url.replace ( /coub.com\/view/g, "https://coub.com/embed/" )
        return url
      }
    },
    datePost () {
      let date = moment ( this.post.data * 1000 )
      return date.format ( 'MMMM DD YYYY, HH:mm' )
    },
    postMessage () {
      let message = this.post.message
      message = message.replace ( /((http(s)?:\/\/)|(www\.))([^\.]+)\.([^\s]+)/g, "<a href='$&' target=\"_blank\">$&</a>" )
      return message
    }
  },
  methods : {
    show ( e ) {
      console.log ( e )
    },
    collage () {
      let collage = this.$el.querySelector ( '#collage' );
      let images = collage.getElementsByTagName ( "img" )
      let video = collage.getElementsByTagName ( "video" )
      let album = [];
      for(let i = 0; i < images.length; i++){
        album.push(images[i])
      }
      for(let i = 0; i < video.length; i++){
        album.push(video[i])
      }
      let options = { averageRowHeight : 300, gap : 2 };
      let widths = [], rows = [], rowNumber = 0, index = 0;
      for ( let i = 0; i < album.length; i++ ) {
        if(album[i].tagName === 'IMG'){
          widths.push ( Math.round ( album[ i ].width / album[ i ].height * options.averageRowHeight ) );
        }else if(album[i].tagName === 'VIDEO'){
          if ( album[ i ].videoWidth && album[ i ].videoHeight) {
            widths.push ( Math.round ( album[ i ].videoWidth / album[ i ].videoHeight * options.averageRowHeight ) );
          }
          else {
            widths.push ( Math.round ( album[ i ].clientWidth / album[ i ].clientHeight * options.averageRowHeight ) );
          }
        }
      }

      Array.prototype.sum = function () {
        return this.reduce ( function ( prev, current ) {
          return +current + prev;
        }, 0 );
      }
      while ( rowNumber < Math.ceil ( widths.sum () / collage.clientWidth ) ) {
        rows[ rowNumber ] = [];
        while ( index < widths.length && rows[ rowNumber ].sum () + ( rows[ rowNumber ].length * options.gap ) < collage.clientWidth + options.gap ) {
          rows[ rowNumber ].push ( widths[ index ] );
          index++;
          if ( index === widths.length - 1 ) {
            rows[ rowNumber ].push ( widths[ index ] );
            rowNumber++;
            break;
          }
        }
        rowNumber++;
      }
      index = 0;
      for ( let c = 0; c < rows.length; c++ ) {
        if(typeof rows[ c ] !== 'undefined'){
          for ( let j = 0; j < rows[ c ].length; j++ ) {
            if(typeof album[ index ] !== 'undefined') {
              album[ index ].style.width = rows[ c ][ j ] * ( ( collage.clientWidth - ( ( rows[ c ].length - 1 ) * options.gap ) ) / rows[ c ].sum () ) + 'px';
              album[ index ].style.height = ( ( collage.clientWidth - ( ( rows[ c ].length - 1 ) * options.gap ) ) / rows[ c ].sum () ) * options.averageRowHeight + 'px';
              if ( j < rows[ c ].length - 1 ) album[ index ].style.marginRight = options.gap + 'px';
              if ( c < rows.length - 1 ) album[ index ].style.marginBottom = options.gap + 'px';
              index++;
            }
          }
        }
      }
      this.mediaLoad = {
        images: false,
        video: false
      }
    },
     bindImagesOnload ( node, fn, fn2 ) {
      let images = node.getElementsByTagName ( "img" )
      let video = node.getElementsByTagName ( "video" )
      let length = images.length;
      let lengthV = video.length;
      let counter = 0;
      let counterV = 0;

      let onload =  () => {
        if(images.length !== undefined){
          counter++;
          if ( counter >= length)
            fn ();
        }
      };
      let onloadV =  () => {
          counterV++;
          if ( counterV >= lengthV)
            fn2 ();
      };
      for ( let i = 0; i < length; i++ ) {
        images[ i ].onload = onload;
      }
      for ( let i = 0; i < lengthV; i++ ) {
        video[ i ].addEventListener('canplaythrough', onloadV)

      }

    },
    openPhoto ( url ) {
// создадим элемент с прокруткой
      let div = document.createElement ( 'div' );

      div.style.overflowY = 'scroll';
      div.style.width = '50px';
      div.style.height = '50px';
      div.style.visibility = 'hidden';

      document.body.appendChild ( div );
      let scrollWidth = div.offsetWidth - div.clientWidth;
      document.body.removeChild ( div );

      // body.style.visibility = 'hidden';
      this.$store.commit ( 'OPEN_GALLERY', { url : url, open : true } )
      document.body.style.overflow = 'hidden'
      document.body.style.paddingRight = `${scrollWidth}px`

    }
  },
 mounted () {
    if ( this.post.media.type === 2 && ( this.linkMediaPhoto || this.linkMediaVideo ) ) {
      let collage = this.$el.querySelector ( '#collage' );


     this.bindImagesOnload(collage, ()=>{
        this.mediaLoad = {
          images: true,
          video: false
        }
        // this.mediaLoad.images = true
        console.log('load')
      }, ()=>{
        this.mediaLoad = {
          images: true,
          video: true
        }
        // this.mediaLoad.video = true
        console.log('loadV')
      });
      window.addEventListener('resize', () => {
          let images = collage.getElementsByTagName ( "img" )
        setTimeout(()=>{
          for ( let i =0 ; i < images.length; i++ ){
            images[i].style = ''
          }
          this.collage()
        },100)


      })
      // function bindImagesOnload(node, fn) {
      //   images = node.getElementsByTagName("img")
      //   let length = images.length;
      //   let counter = 0;
      //   let onload = function() {
      //     counter++;
      //     if (counter >= length)
      //       fn();
      //   };
      //   for (let i = 0; i < length; i++) {
      //     images[i].onload = onload;
      //   }
      // }

    }
  }
}
</script>

<style scoped lang="scss">
  [v-cloak]{
    display: none;
  }
  #collage:after {
    content: '';
    display: block;
    clear: both;
  }

  #collage {
    width: 100%;
    overflow: hidden;
  }

  #collage img {
    display: block;
    float: left;
    object-fit: cover;
    width: 100%;
    height: auto;
    transition: all .3s;
  }

  #collage .video {
    display: block;
    float: left;
    video{
      width: 100%;
    }
  }

</style>