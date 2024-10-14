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

        <div class="grid lg:grid-cols-4 gap-6" v-if="menus.length > 0">
            <div class="mb-2 rounded-lg shadow-lg" v-for="menu in menus">
                <a :href="`/menus/${menu.name}`">
                    <img class="mx-auto max-w-full h-48"
                         :src="menu.image"
                         alt="Menu Image"
                    />

                    <div class="px-6 py-4">
                        <div class="flex mb-2 h-6">
                        <span :class="{ 'opacity-0' : !menu.special }" class="px-4 py-0.5 text-sm bg-red-500 rounded-full text-red-50">
                            Special menu
                        </span>
                        </div>

                        <h4 class="mb-3 text-xl font-semibold tracking-tight text-green-600 hover:text-green-400 uppercase">
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
import toast from '@/components/Global/Toast.vue'

export default {
    components: {
        toast,
    },

    data() {
        return {
            menus: [],
            query: null,
            errorMessage: 'Something went wrong while fetching menus',
        }
    },

    watch: {
        query(value) {
            if (value === '') {
                this.fetchMenus();
            }
        }
    },

    mounted() {
        this.fetchMenus()
    },

    methods: {
        fetchMenus() {
            axios.get('api/menus')
                .then((response) => {
                    this.menus = response.data;
                })
                .catch(() => {
                    this.$refs.toast.toastError(this.errorMessage);
                })
        },

        search() {
            axios.get('api/menus/search', {
                params: {
                    query: this.query
                }
            })
                .then((response) => {
                    this.menus = response.data;
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
