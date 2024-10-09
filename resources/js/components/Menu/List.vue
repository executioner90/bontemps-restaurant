<template>
    <div class="grid lg:grid-cols-4 gap-6">
        <Toast ref="toast" />

        <div class="mb-2 rounded-lg shadow-lg">
            <a href="">
                <img class="mx-auto max-w-full h-48"
                     src=""
                     alt="Menu Image"
                />
                <div class="px-6 py-4">
                    <div class="flex mb-2">
                        <span class="px-4 py-0.5 text-sm bg-red-500 rounded-full text-red-50">
                            Special menu
                        </span>
                    </div>

                    <h4 class="mb-3 text-xl font-semibold tracking-tight text-green-600 hover:text-green-400 uppercase">
                        {{ }}
                    </h4>
                </div>
            </a>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Toast from '../Global/Toast.vue'

export default {
    components: {
        Toast
    },

    data() {
        return {
            menus: [],
        }
    },

    mounted() {
        this.fetchMenus()
    },

    methods: {
        fetchMenus() {
            axios.get('api/get-menus')
                .then((response) => {
                    this.menus = response.data;
                })
                .catch(() => {
                    this.$refs.toast.toastWarning('This is a Tailwind toast message!');
                })
        }
    }
}
</script>
