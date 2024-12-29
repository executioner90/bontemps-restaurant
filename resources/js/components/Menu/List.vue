<template>
    <div>
        <toast ref="toast"/>

        <div class="w-full search-box">
          <h2 class="text-4xl font-bold text-blue-500 mb-8">Our Menus</h2>

          <search
              @success="(value) => menus = value"
              @fetch-all="fetchMenus"
              @failed="searchFailed"
          />
        </div>

        <div class="grid lg:grid-cols-4 gap-6" v-if="menus.length > 0">
          <div class="mb-2 shadow-lg relative" v-for="menu in menus">
            <!-- Badge -->
            <div class="absolute">
              <span :class="{ 'opacity-0': !menu.special }"
                class="px-4 py-0.5 text-sm bg-red-500 text-red-50">
                  Special menu
               </span>
            </div>

            <!-- Card Content -->
            <a :href="`/menus/${menu.name}`">
              <!-- Image -->
              <img class="mx-auto max-w-full"
                   :src="menu.image"
                   :alt="`${menu.name} image`"
              />

              <!-- Text Content -->
              <div class="px-6 py-4">
                <h4 class="mb-3 text-xl text-center font-semibold tracking-tight text-green-600 hover:text-green-400 uppercase">
                  {{ menu.name }}
                </h4>
              </div>
            </a>
          </div>
        </div>

        <div class="text-center mt-2" v-else>
            <p>No matches found...</p>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import toast from '@/components/Global/Toast.vue';
import Search from '@/components/Global/Search.vue';

export default {
    components: {
      Search,
        toast,
    },

    data() {
        return {
            menus: [],
            query: null,
            errorMessage: 'Something went wrong while fetching menus',
        }
    },

    mounted() {
        this.fetchMenus()
    },

    methods: {
        fetchMenus() {
            axios.get('api/menu')
                .then((response) => {
                    this.menus = response.data;
                })
                .catch(() => {
                    this.$refs.toast.toastError(this.errorMessage);
                })
        },

      searchFailed() {
        this.$refs.toast.toastError(this.errorMessage);
      }
    }
}
</script>

<style scoped>
.search-box {
    margin-bottom: 1rem !important;
}
</style>
