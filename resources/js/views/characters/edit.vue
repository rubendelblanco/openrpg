<template>
    <div>
        <h2>Editar personaje</h2>
        <validation-errors :errors="validationErrors" v-if="validationErrors"></validation-errors>
        <success-message :success="success" :success_message="success_message" v-if="success"></success-message>
        <div class="panel-body">
            <form @submit="submitForm">
                <vue-form-generator :schema="schema" :model="characterModel" :options="formOptions" ref="characterForm"></vue-form-generator>
                <b-button type="submit">Editar personaje</b-button>
            </form>
        </div>
    </div>
</template>

<script>
    import schema from "./schemas/character-schema";
    export default {
        data() {
            return {
                characterModel: {

                },
                schema,
                formOptions: {
                    validateAsync: true
                },
                success_message: "",
                submit_url: `/api/characters/${this.$route.params.id}`,
                errors: [],
                success: false,
                validationErrors: "",
                options: [],
                isLoading: false,
            };
        },
        mounted() {
            axios
                .get(`/api/characters/${this.$route.params.id}`)
                .then(res => {
                    this.characterModel = res.data;
                })
                .catch(err => {
                    this.errors.push(err);
                }).then(this.getUsers).then(options => {
                    this.schema.selectField.values = options;
            });
        },
        methods: {
            submitForm(e) {
                e.preventDefault();
                axios
                    .put(this.submit_url, this.characterModel)
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
            },
            getUsers(ctx, callback) {
                return new Promise((res, rej) => {
                    axios.get("/api/users").then(response => {
                        res(response.data.map(u => ({id:u.id, name: `${u.name} (${u.email})`})));
                    });
                });

            },
        }
    };
</script>