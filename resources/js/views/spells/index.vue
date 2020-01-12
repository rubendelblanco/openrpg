<template>
  <div class="autocomplete">
    <input v-focus type="text" v-model="search" @input="onChange" class="form-control" />
    <ul v-show="isOpen" class="autocomplete-results">
      <div v-if="matches.length">
        <li v-for="(match, i) in matches" :key="i" class="autocomplete-result">
            <router-link :to="{name: 'spell-detail', params: {id: match.id}}">
                {{ match.text }}
            </router-link>
        </li>
      </div>
      <div v-if="!matches.length">
        <li class="autocomplete-result">
          <span>No results found</span>
        </li>
      </div>
    </ul>
  </div>
</template>

<script>
import { fetchSpellSuggestions } from "./api";

export default {
  name: "spells-autocomplete",
  props: {
    suggestions: {
      type: Array,
      required: false,
      default: () => []
    }
  },
  data() {
    return {
      isOpen: false,
      search: "",
      matches: []
    };
  },
  methods: {
    onChange() {
      const payload = this.search.trim();
      if (payload.length > 0) {
        fetchSpellSuggestions(this.search.trim())
          .then(this.handleSuggestionsReceived)
          .catch(err => console.error(err));
      } else {
        this.matches = [];
        this.isOpen = false;
      }
    },
    handleSuggestionsReceived(suggs) {
      this.isOpen = true;
      this.matches = suggs;
    }
  },
  directives: {
    focus: {
      inserted: function(el) {
        el.focus();
      }
    }
  }
};
</script>

<style>
.autocomplete {
  position: relative;
  width: 530px;
}

.autocomplete-results {
  padding: 0;
  margin: 0;
  border: 1px solid #eeeeee;
  height: 120px;
  overflow: auto;
}

.autocomplete-result {
  list-style: none;
  text-align: left;
  padding: 4px 2px;
  cursor: pointer;
}

.autocomplete-result:hover {
  background-color: #4aae9b;
  color: white;
}
</style>
