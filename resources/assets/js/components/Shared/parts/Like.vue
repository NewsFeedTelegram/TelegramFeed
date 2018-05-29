<template>
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
</template>

<script>
export default {
  name : "Like"
}
</script>

<style scoped>

</style>