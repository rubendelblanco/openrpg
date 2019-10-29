<template>
    <span class="hamburger-menu" v-bind:class="[isOverlay ? '' : 'hamburguer-overlay']" ></span>
</template>

<script>
export default {
    props : ['overlay'],
    computed: {
        isOverlay() {
        return this.overlay;
        }
    }
}
</script>

<style scoped>
  .hamburger-menu:before{
    content:'\2630';
    font-size: 40px;
  }
  .hamburger-menu{
    float:left;
    cursor:pointer;
  }
  .hamburguer-overlay{
    position: fixed; /* Sit on top of the page content */
    color: #ffffff;
    z-index: 3; /* Specify a stack order in case you're using a different order for other elements */
  }
</style>