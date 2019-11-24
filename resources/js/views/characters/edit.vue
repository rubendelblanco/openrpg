<template>
    <div>
        <h2>Editar personaje</h2>
        <validation-errors :errors="validationErrors" v-if="validationErrors"></validation-errors>
        <success-message :success="success" :success_message="success_message" v-if="success"></success-message>
        <div class="panel-body">
            <div class="container-fluid">
                <form @submit="submitForm">
                    <div class="row my-1">
                        <div class="col-sm-3"><label for="user-name">Usuario</label></div>
                        <div class="col-sm-4">
                            <b-form-select id="user-name" v-model="selected" :options="options"></b-form-select>
                        </div>
                        <div class="col-sm-5"></div>
                    </div>
                    <div class="row my-1">
                        <div class="col-sm-3"><label for="character-name">Nombre</label></div>
                        <div class="col-sm-4">
                            <b-form-input id="character-name" v-model="characterModel.name"></b-form-input>
                        </div>
                        <div class="col-sm-5"></div>
                    </div>
                    <div class="row my-1">
                        <div class="col-sm-3"><label for="experience">Experiencia</label></div>
                        <div class="col-sm-4">
                            <b-form-input id="experience" v-model="characterModel.experience" type="number" min="0"></b-form-input>
                        </div>
                        <div class="col-sm-5"></div>
                    </div>
                    <div class="row my-1">
                        <b-button type="submit">Editar personaje</b-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                characterModel: {
                    name : '',
                    experience: ''
                },
                selected: null,
                success_message: "",
                submit_url: `/api/characters/${this.$route.params.id}`,
                errors: [],
                success: false,
                validationErrors: "",
                options: [],
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
                }).then(this.getUsers);
        },
        methods: {
            submitForm(e) {
                e.preventDefault();
                this.characterModel.user = this.characterModel.user_id;
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
                        this.options = response.data.map(u => ({value:u.id, text: `${u.name} (${u.email})`}));
                        this.selected = this.characterModel.user_id;
                    });
                });

            },
        }
    };
</script>