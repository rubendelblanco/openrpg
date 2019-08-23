<template>
  <div v-if="validationErrors.length > 0">
    <ul class="alert alert-danger">
      <li v-for="(value, key) in validationErrors" :key="key">{{ value }}</li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {};
  },
  props: ["errors"],
  computed: {
    validationErrors() {
      let errors = Object.values(this.errors);
      errors = errors.flat();
      return errors;
    }
  }
};
</script>