<template>
  <div>
    <b-table
      id="my-table"
      busy.sync="true"
      :items="users"
    ></b-table>
  </div>
</template>

<script>
  export default {
    data () {
      return {
        users:[],
        isBusy: false
      }
    },
    mounted() {
            this.getResults();
        },
    methods: {
        // Our method to GET results from a Laravel endpoint
        getResults(ctx, callback) {
            axios.get('/api/users')
                .then(response => {
                    this.users = response.data;
                    this.totalRows = response.data.length;
                    return this.users;
                });
        }
    },
  }
</script>