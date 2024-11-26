<template>
    <div>
        <toast ref="toast"/>

        <div class="w-full search-box">
            <input
                v-model="query"
                class="w-1/2 border-gray-300 rounded-left"
                type="text"
                placeholder="Search your menu"
            >

            <button
                @click="search"
                class="bg-green-500 hover:bg-green-700 rounded-right py-2 px-4 text-white"
            >
                Search
            </button>
        </div>

        <div class="grid lg:grid-cols-4 gap-6">
            <div class="mb-2 rounded-lg shadow-lg flex flex-col" v-for="meal in meals">
                <a :href="`/menus/${meal.name}`" class="flex flex-col flex-grow">
                    <img class="mx-auto max-w-full h-48"
                         :src="meal.image"
                         alt="Menu Image"
                    />

                    <div class="px-6 py-4 flex-grow">
                        <div class="flex mb-2 h-6">
                            <span class="px-4 py-0.5 text-sm bg-red-500 rounded-full text-red-50">
                                {{ menuName }}
                            </span>
                        </div>

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
import toast from '@/components/Global/Toast.vue';

export default {
    components: {
        toast,
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

    watch: {
        query(value) {
            if (value === '') {
                this.fetchMeals();
            }
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

        search() {
            axios.get(`/api/menu/${this.menuId}/meals/search`, {
                params: {
                    query: this.query
                }
            })
                .then((response) => {
                    this.meals = response.data;
                })
                .catch(() => {
                    this.$refs.toast.toastError(this.errorMessage);
                })
        }
    }
}
</script>

<style scoped>
.search-box {
    margin-bottom: 1rem !important;
}

.rounded-left {
    border-radius: 0.3rem 0 0 0.3rem !important;
}

.rounded-right {
    border-radius: 0 0.3rem 0.3rem 0 !important;
}
</style>
