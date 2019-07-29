<template>
    <button type="submit" class="btn btn-secondary" v-on:click="send">{{value}}</button>
</template>

<script>
  export default {
    props: ['value','url','data'],
    methods:{
        send: function (event) {
            event.preventDefault()
            axios.post(this.url)
                .then(res => {
                    console.log(res);
                    console.log('conectado API');
                })
                .catch(err => {
                    console.log('cagada');
                })
        }
    }
  }
</script>