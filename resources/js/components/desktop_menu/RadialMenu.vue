<template>
  <div v-if="!isHidden">
      <radial-menu
        style="margin: auto; margin-top: 300px; background-color: white"
        :itemSize="50"
        :radius="120"
        :angle-restriction="180" id=main-menu>
          <radial-menu-item 
            v-for="(item, index) in items" 
            :key="item" 
            style="background-color: white" 
            @click="() => handleClick(item)">
            <span>{{index}}</span>
          </radial-menu-item>
        </radial-menu>
    </div>
</template>
 
<script>
import { RadialMenu,  RadialMenuItem } from 'vue-radial-menu'
 
export default {
  components: {
    RadialMenu,
    RadialMenuItem
  },
  props: ['hidden'],
  data () {
    return {
      items: {'users':'user_index'},
    }
  },
  methods: {
    handleClick (item) {
       this.$router.push({'name':item})
    }
  },
  computed: {
    isHidden() {
      return this.hidden;
    }
  }
}
</script> 

<style scoped>
  #main-menu {
    position: fixed; /* Sit on top of the page content */
    width: 100%; /* Full width (cover the whole page) */
    height: 100%; /* Full height (cover the whole page) */
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 2; /* Specify a stack order in case you're using a different order for other elements */
    cursor: pointer; /* Add a pointer on hover */
}
</style>

