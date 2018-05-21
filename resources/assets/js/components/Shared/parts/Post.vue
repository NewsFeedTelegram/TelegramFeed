<template>
  <div class="white-block">
    <article class="post">
      <div class="post--author">
        <div class="post--author-user">
          <img src="img/bg.jpg" alt="author">
          <div class="post--author-date">
            <a class="h6 post--author-name fn" href="#">Телеблог блог о телеграм </a>
            <!--<span class="share">shared-->
            <!--a <a href="#">link</a></span>-->
            <div class="post--date">
              <time class="published" datetime="2018-05-1T15:18">
                <a href="#">@teleblog</a> May 1 at 2:05pm
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
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto dolor eius et
        facere
        fuga quaerat quasi temporibus, tenetur ullam veritatis. Accusamus adipisci aliquid
        assumenda aut autem beatae blanditiis deleniti deserunt distinctio doloremque,
        doloribus
        eius eligendi error eveniet excepturi exercitationem expedita facilis fuga fugit
        harum
        impedit incidunt, inventore iste itaque laboriosam laudantium magni mollitia nemo
        numquam officia possimus quae quaerat repellendus tempore temporibus, ullam vero. Ab
        architecto blanditiis corporis, deleniti dicta excepturi exercitationem id illum
        impedit
        labore molestiae nisi officia praesentium quia saepe suscipit ut velit,
        voluptatibus. A
        animi consequatur, delectus et harum iure, labore maiores necessitatibus nemo omnis
        sapiente voluptates?</p>
      <div class="post-additional-info">
        <div class="post-like">
          <a href="#" class="post-add-icon">
            <svg class="icon icon-heart">
              <use xlink:href="#icon-heart"></use>
            </svg>
            <span>24</span>
          </a>
          <ul class="friends-like">
            <li>
              <a href="#">
                <img src="img/bg.jpg" alt="friend">
              </a>
            </li>
            <li>
              <a href="#">
                <img src="img/bg.jpg" alt="friend">
              </a>
            </li>
            <li>
              <a href="#">
                <img src="img/bg.jpg" alt="friend">
              </a>
            </li>
            <li>
              <a href="#">
                <img src="img/bg.jpg" alt="friend">
              </a>
            </li>
            <li>
              <a href="#">
                <img src="img/bg.jpg" alt="friend">
              </a>
            </li>
          </ul>
          <div class="names-people-likes">
            <a href="#">You</a>, <a href="#">Elaine</a> and
            <br>22 more liked this
          </div>
        </div>
        <div class="post-comments-shared">
          <a href="#" class="post-add-icon inline-items">
            <svg class="icon icon-chat-comment">
              <use xlink:href="#icon-chat-comment"></use>
            </svg>
            <span>17</span>
          </a>

          <a href="#" class="post-add-icon inline-items">
            <svg class="icon icon-reply-all">
              <use xlink:href="#icon-reply-all"></use>
            </svg>
            <span>24</span>
          </a>
        </div>
      </div>
      <div class="post-additional-comment">
        <img src="img/bg.jpg" alt="">
        <div class="comment-field" :class="{focus: btnShow}" contenteditable="true" @focus="btnShow=true" @blur="$event.target.textContent !== '' ? btnShow=true : btnShow=false" placeholder="Your comment..."></div>
        <!--<textarea name="" id="" cols="30" rows="10" placeholder="Your comment..." ></textarea>-->
        <button v-show="btnShow">
          <svg class="icon icon-send">
            <use xlink:href="#icon-send"></use>
          </svg>
        </button>
      </div>
    </article>
  </div>
</template>

<script>
export default {
  name : "Post",
  data(){
    return{
      btnShow: false
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
  .more {
    position: relative;
    display: flex;
    .icon {

    }
    &:hover .more-dropdown {
      visibility: visible;
      opacity: 1;
    }
    &-dropdown {
      display: block;
      position: absolute;
      top: 100%;
      right: 0;
      width: 180px;
      box-shadow: 0 0 34px 0 rgba(63, 66, 87, .1);
      background-color: #fff;
      border-radius: 4px;
      visibility: hidden;
      opacity: 0;
      transition: all .3s;
      text-align: left;
      padding: 5px 0;
      z-index: 5;
      font-size: .75rem;
      list-style: none;
      a {
        text-decoration: none;
        transition: .3s;
        display: block;
        &:hover {
          color: #50bfa4;
        }
      }

      li {
        padding: 10px 15px;
        background-color: transparent;
      }
    }
  }

</style>