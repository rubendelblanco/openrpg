<template>
    <div>
        <validation-errors :errors="validationErrors" v-if="validationErrors"></validation-errors>
        <success-message :success="success" :success_message="success_message" v-if="success"></success-message>
        <div class="panel-body">
            <form @submit="submitForm">
                <vue-form-generator :schema="schema" :model="model" :options="formOptions"></vue-form-generator>
                <b-button type="submit">Crear Personaje</b-button>
            </form>
        </div>
    </div>
</template>

<script>
    import schema from "./schemas/character-schema";
    export default {
        data() {
            return {
                model: {
                  /*  name: "",
                    experience: ""*/
                },
                schema,
                formOptions: {
                    validateAfterLoad: true,
                    validateAsync: true
                },
                errors: [],
                submit_url: `/api/characters/`,
                validationErrors: "",
                success: false,
                success_message: ""
            };
        },
        mounted() {
            this.getUsers();
        },
        methods: {
            submitForm(e) {
                e.preventDefault();
                axios
                    .post(this.submit_url, this.model)
                    .then(res => {
                        if (res.status == 200) {
                            this.validationErrors = "";
                            this.success = true;
                            this.success_message = res.data.message;
                        }
                    })
                    .catch(err => {
                        if (err.response.status == 422) {
                            this.errors.push(err.response.data.errors);
                            this.validationErrors = err.response.data.errors;
                        }
                    });
            },
            getUsers(ctx, callback) {
                axios.get("/api/users").then(response => {
                    this.schema.selectField.values = response.data.map(u => ({id:u.id, name:u.name+' ('+u.email+')'}));
                });
            },
        }
    };
</script>

<style>
</style>
