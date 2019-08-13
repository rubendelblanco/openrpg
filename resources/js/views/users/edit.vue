<template>
  <div>
    <h2>Editar usuario {{model.name}}</h2>
    <validation-errors :errors="validationErrors" v-if="validationErrors"></validation-errors>
    <success-message :success="success" :success_message="success_message" v-if="success"></success-message>
    <i>Dejar los campos password sin rellenar si no se quiere resetear</i>
    <div class="panel-body">
      <form @submit="submitForm">
        <vue-form-generator :schema="schema" :model="model" :options="formOptions"></vue-form-generator>
        <b-button type="submit">Editar usuario</b-button>
      </form>
    </div>
  </div>
</template>

<script>
import schema from "./schemas/user-schema";
export default {
  data() {
    return {
      model: {
        name: "",
        email: "",
        password: "",
        repeat_password: ""
      },
      schema,
      formOptions: {
        validateAsync: true
      },
      success_message: "",
      submit_url: `/api/users/${this.$route.params.id}`,
      errors: [],
      success: false,
      validationErrors: ""
    };
  },
  mounted() {
    schema.fields[2].required = false;
    schema.fields[3].required = false;
    axios
      .get(`/api/users/${this.$route.params.id}`)
      .then(res => {
        this.model = res.data[0];
      })
      .catch(err => {
        this.errors.push(err);
      });
  },
  methods: {
    submitForm(e) {
      e.preventDefault();
      axios
        .put(this.submit_url, this.model)
        .then(res => {
          if (res.status === 200) {
            this.validationErrors = "";
            this.success = true;
            this.success_message = res.data.message;
          }
        })
        .catch(err => {
          if (err.response.status === 422) {
            this.validationErrors = err.response.data.errors;
          }
        });
    }
  }
};
</script>