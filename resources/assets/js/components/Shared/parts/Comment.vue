<template>
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
</template>

<script>
export default {
  name : "Comment"
}
</script>

<style scoped>

</style>