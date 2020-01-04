<template>
    <div @click="handleClick">
    <b-alert v-if="isSuccess" show variant="success">{{ success_message }}</b-alert>
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
  },
    methods:{
        handleClick() {
            this.$emit('click')
        }
    }
};
</script>

<style>
</style>
