<template>
    <div>
        <validation-errors :errors="validationErrors" v-if="validationErrors"></validation-errors>
        <b-table id="character-table" busy.sync="true" :items="characters" :fields="fields" ref="character_table">
            <template slot="actions" slot-scope="row">
                <router-link :to="{name: 'character_show', params: {id: row.item.id}}">
                    <b-button size="sm" class="mr-1">Ver</b-button>
                </router-link>
                <router-link :to="{name: 'character_edit', params: {id: row.item.id}}">
                    <b-button size="sm" class="mr-1">Editar</b-button>
                </router-link>
                <b-button
                        size="sm"
                        class="mr-1"
                        @click="confirmDeleteCharacter(row.item.id)"
                >Eliminar</b-button>
            </template>
        </b-table>
        <b-modal ref="modal-confirm-delete" id="modal-confirm-delete" hide-footer>
            <div class="d-block text-center">
                <p>¿Quieres borrar este personaje?</p>
                <b-button size="md" variant="success" @click="ok(character_confirm.id)">OK</b-button>
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
                    { key: "level" },
                    { key: "experience"},
                    { key: "actions" }
                ],
                characters: [],
                validationErrors: [],
                isBusy: false,
                character_confirm: {}
            };
        },
        mounted() {
            this.getResults();
        },
        methods: {
            getResults(ctx, callback) {
                axios.get("/api/characters").then(response => {
                    this.characters = response.data;
                    this.totalRows = response.data.length;
                    return this.characters;
                });
            },
            confirmDeleteCharacter(id, email) {
                this.character_confirm = {
                    id: id,
                };
                this.$refs["modal-confirm-delete"].show();
            },
            ok(id) {
                axios
                    .delete(`api/characters/${id}`)
                    .then(response => {
                        this.$bvModal.hide("modal-confirm-delete");
                        this.character_confirm = {};
                        this.characters = this.characters.filter(character => character.id != id);
                    })
                    .catch(err => {
                        if (err.response.status === 403) {
                            this.$bvModal.hide("modal-confirm-delete");
                            this.character_confirm = {};
                            this.validationErrors.push(err.response.data.message);
                        }
                    });
            },
            cancel() {
                this.$bvModal.hide("modal-confirm-delete");
                this.character_confirm = {};
            }
        }
    };
</script>