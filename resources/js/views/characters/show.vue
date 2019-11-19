<template>
    <div>
        <h2>{{character.name}}</h2>
        <div class="row">
            <div class="col-md-12 mb-5">
                <router-link :to="{name: 'character_edit', params: {id: character.id}}">
                    <b-button size="sm" class="mr-1">Editar</b-button>
                </router-link>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                Nombre:
                <span id="charactername">{{character.name}}</span>
            </div>
            <div class="col-md-4">
                Experiencia:
                <span id="characterxp">{{character.experience}}</span>
            </div>
            <div class="col-md-4">
                Experiencia:
                <span id="characterlevel">{{character.level}}</span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                character: {}
            };
        },
        mounted() {
            axios
                .get(`/api/characters/${this.$route.params.id}`)
                .then(res => {
                    this.character = res.data;
                })
                .catch(err => {
                    console.log("cagada");
                });
        }
    };
</script>