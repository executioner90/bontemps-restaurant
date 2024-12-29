<template>
  <div>
    <input
        v-model="query"
        class="w-1/3 border-gray-300"
        type="text"
        placeholder="Search your menu"
    >

    <button
        @click="search"
        class="bg-green-500 hover:bg-green-700 py-2 px-4 text-white"
    >
      Search
    </button>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      query: null,
    }
  },

  props: {
    menuId: {
      type: Number,
      default: null,
    },
  },

  watch: {
    query(value) {
      if (value === '') {
        this.$emit('fetch-all')
      }
    }
  },

  computed: {
    apiUrl() {
      return this.menuId ? `/api/menu/${this.menuId}/meals/search` : `api/menu/search`;
    },
  },

  methods: {
    search() {
      axios.get(this.apiUrl, {
        params: {
          query: this.query
        }
      })
          .then((response) => {
            // this.meals = response.data;
            this.$emit('success', response.data);
          })
          .catch(() => {
            this.$emit('failed');
          });
    }
  }
}
</script>