<template>
  <div v-if="isSuccess">
    <b-alert show variant="success">{{ success_message }}</b-alert>
  </div>
</template>

<script>
export default {
  data() {
    return {};
  },
  props: ["success", "success_message"],
  computed: {
    isSuccess() {
      return this.success;
    }
  }
};
</script>

<style>
</style>
