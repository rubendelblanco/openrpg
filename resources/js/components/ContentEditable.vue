<template>
    <div contenteditable="true" @input="update">{{content}}</div>
</template>

<script>
  export default {
    methods: {
        update:function(event){
            this.$emit('update',event.target.innerText);
        }
    },
    props: ['content']
  }
</script>
