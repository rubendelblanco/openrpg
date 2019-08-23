<template>
  <div>
    <validation-errors :errors="validationErrors" v-if="validationErrors"></validation-errors>
    <b-table id="user-table" busy.sync="true" :items="users" :fields="fields" ref="user_table">
      <template slot="actions" slot-scope="row">
        <router-link :to="{name: 'user_show', params: {id: row.item.id}}">
          <b-button size="sm" class="mr-1">Ver</b-button>
        </router-link>
        <router-link :to="{name: 'user_edit', params: {id: row.item.id}}">
          <b-button size="sm" class="mr-1">Editar</b-button>
        </router-link>
        <b-button
          size="sm"
          class="mr-1"
          @click="confirmDeleteUser(row.item.id, row.item.email)"
        >Eliminar</b-button>
      </template>
    </b-table>
    <b-modal ref="modal-confirm-delete" id="modal-confirm-delete" hide-footer>
      <div class="d-block text-center">
        <p>¿Quieres borrar este usuario? {{user_confirm.email}}</p>
        <b-button size="md" variant="success" @click="ok(user_confirm.id)">OK</b-button>
        <b-button size="md" variant="danger" @click="cancel()">Cancel</b-button>
      </div>
    </b-modal>
  </div>
</template>

<script>
export default {
  data() {
    return {
      fields: [
        { key: "name" },
        { key: "email" },
        { key: "created_at" },
        { key: "actions" }
      ],
      users: [],
      validationErrors: [],
      isBusy: false,
      user_confirm: {}
    };
  },
  mounted() {
    this.getResults();
  },
  methods: {
    // Our method to GET results from a Laravel endpoint
    getResults(ctx, callback) {
      axios.get("/api/users").then(response => {
        this.users = response.data;
        this.totalRows = response.data.length;
        return this.users;
      });
    },
    confirmDeleteUser(id, email) {
      this.user_confirm = {
        id: id,
        email: email
      };
      this.$refs["modal-confirm-delete"].show();
    },
    ok(id) {
      axios
        .delete(`api/users/${id}`)
        .then(response => {
          console.log(response);
          this.$bvModal.hide("modal-confirm-delete");
          this.user_confirm = {};
          this.users = this.users.filter(user => user.id != id);
        })
        .catch(err => {
          if (err.response.status === 403) {
            this.$bvModal.hide("modal-confirm-delete");
            this.user_confirm = {};
            this.validationErrors.push(err.response.data.message);
          }
        });
    },
    cancel() {
      this.$bvModal.hide("modal-confirm-delete");
      this.user_confirm = {};
    }
  }
};
</script>