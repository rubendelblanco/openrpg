<template>
  <div>
    <div class="row">
      <div class="col-md-12 mb-5">
        <router-link :to="{name: 'spells'}">
          <b-button size="sm" class="mr-1">Buscar otro hechizo</b-button>
        </router-link>
      </div>
    </div>
    <div>
      <h2>{{spell.name}}</h2>
      <div class="row">
        <div class="col-md-4">
          Nombre:
          <span id="spell-name">{{spell.name}}</span>
        </div>
        <div class="col-md-4">
          Lista:
          <span id="spell-list">{{spell.list_name}}</span>
        </div>
        <div class="col-md-4">
          Nivel:
          <span id="spelllevel">{{spell.level}}</span>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          Codigo:
          <span id="spell-code">{{spell.code}}</span>
        </div>
        <div class="col-md-4">
          Clase:
          <span id="spell-class">{{spell.class}}</span>
        </div>
        <div class="col-md-4">
          Subclase:
          <span id="spell-subclass">{{spell.subclass}}</span>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
            Description:
            <p>{{ spell.description }}</p>
        </div>
        <div class="col-md-6">
            Notas:
            <p>{{ spell.notes || "--" }}</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          Area de efecto:
          <pre>{{ spell.effect_area }}</pre>
        </div>
        <div class="col-md-4">
          Duration:
          <pre>{{ spell.duration }}</pre>
        </div>
        <div class="col-md-4">
          Range:
          <pre>{{ spell.range }}</pre>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
function prettyPrint(data) {
  return JSON.stringify(JSON.parse(data), null, 2);
}

export default {
  data() {
    return {
      spell: {}
    };
  },
  mounted() {
    axios
      .get(`/api/spells/${this.$route.params.id}`)
      .then(res => {
        this.spell = {
          ...res.data,
          effect_area: prettyPrint(res.data.effect_area),
          duration: prettyPrint(res.data.duration),
          range: prettyPrint(res.data.range)
        };
      })
      .catch(err => {
        console.log("cagada");
      });
  }
};
</script>