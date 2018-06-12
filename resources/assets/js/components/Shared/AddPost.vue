<template>
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
</template>

<script>
export default {
  name : "AddPost"
}
</script>

<style scoped>

</style>