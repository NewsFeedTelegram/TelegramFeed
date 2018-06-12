<template>
  <aside :class="[asideClass]">
      <div v-sticky="{ zIndex: 20, stickyTop: 15, disabled: false}" class="white-block">
        <div>
          <div class="white-block-title">
            <h6 class="title">Add chanel</h6>
            <a href="#" class="more">
              <svg class="icon icon-more-button">
                <use xlink:href="#icon-more-button"></use>
              </svg>
            </a>
          </div>
        </div>
      </div>
  </aside>
</template>

<script>
import VueSticky from 'vue-sticky'

export default {
  name : "AsideLeft",
  props:{
    asideClass: {
      type: String
    }
  },
  directives : {
    'sticky' : VueSticky,
  },
}
</script>

<style scoped>

</style>