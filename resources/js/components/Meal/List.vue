<template>
    <div>
        <toast ref="toast"/>

        <div class="w-full search-box">
          <h2 class="text-4xl font-bold text-blue-500 mb-8">
            {{ menuName }}
          </h2>

          <search
              :menu-id="menuId"
              @success="(value) => meals = value"
              @fetch-all="fetchMeals"
              @failed="searchFailed"
          />
        </div>

        <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <div class="mb-2 shadow-lg flex flex-col" v-for="meal in meals">
                <a :href="`/menus/${meal.slug}`" class="flex flex-col flex-grow">
                    <img class="mx-auto max-w-full"
                         :src="meal.image"
                         alt="Menu Image"
                    />

                    <div class="px-6 py-4 flex-grow">

                        <h4 class="mb-3 text-xl font-semibold tracking-tight text-green-600 hover:text-green-400 uppercase">
                            {{ meal.name }}
                        </h4>

                        <p class="leading-normal text-gray-700 flex-grow">{{ meal.description }}.</p>
                    </div>

                    <div class="flex items-center justify-between p-4">
                        <span class="text-xl text-green-600">&euro; {{ meal.price }}</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Toast from '@/components/Global/Toast.vue';
import Search from '@/components/Global/Search.vue';

export default {
    components: {
      Toast,
      Search,
    },

    props: {
      menuId: {
        type: Number,
        default: null,
      },

      menuName: {
        type: String,
        default: null,
      },
    },

    data() {
      return {
        meals: [],
        query: null,
        errorMessage: 'Something went wrong while fetching meals',
      }
    },

    mounted() {
      this.fetchMeals()
    },

    methods: {
      fetchMeals() {
        axios.get(`/api/menu/${this.menuId}/meals`)
            .then((response) => {
              this.meals = response.data;
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
