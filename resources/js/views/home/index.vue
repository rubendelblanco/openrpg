<template>
  <div>
    <div class="col-12">
      <hamburguer-menu @click.native="hidden=!hidden" :overlay="hidden"></hamburguer-menu>
      <overlay :hidden="hidden"> </overlay>
      <desktop-menu :hidden="hidden"></desktop-menu>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      hidden: true,
    };
  },
};
</script>

<style scoped>

</style>
