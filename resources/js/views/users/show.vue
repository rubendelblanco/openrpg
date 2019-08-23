<template>
  <div>
    <h2>Usuario {{user.name}}</h2>
    <div class="row">
      <div class="col-md-12 mb-5">
        <router-link :to="{name: 'user_edit', params: {id: user.id}}">
          <b-button size="sm" class="mr-1">Editar</b-button>
        </router-link>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        Nombre:
        <span id="username">{{user.name}}</span>
      </div>
      <div class="col-md-4">
        E-mail:
        <span id="useremail">{{user.email}}</span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      user: {}
    };
  },
  mounted() {
    axios
      .get(`/api/users/${this.$route.params.id}`)
      .then(res => {
        this.user = res.data[0];
      })
      .catch(err => {
        console.log("cagada");
      });
  }
};
</script>