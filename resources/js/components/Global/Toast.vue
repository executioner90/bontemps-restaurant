<template>
    <transition name="fade">
        <div
            id="toast"
            v-if="visible"
            class="fixed top-0 left-1/2 right-4 text-white p-4 rounded shadow-lg"
            :class="bgClass"
            @click="closeToast"
        >
            <div class="flex justify-between items-center border-b">
                <strong>{{ title }}</strong>
                <button
                    class="ml-2 text-white hover:underline"
                    @click.stop="closeToast"
                >
                    <i class="fa fa-times"></i>
                </button>
            </div>

            <p class="pt-2">{{ message }}</p>
        </div>
    </transition>
</template>

<script>
export default {
    data() {
        return {
            visible: false,
            message: '',
            title: 'Notification',
            bgClass: '',
        };
    },
    methods: {
        toastSuccess(
            message,
            title = 'Success',
        ) {
            this.visible = true;
            this.message = message;
            this.title = title;
            this.bgClass = 'success';
            this.autoHide();
        },

        toastWarning(
            message,
            title = 'Warning',
        ) {
            this.visible = true;
            this.message = message;
            this.title = title;
            this.bgClass = 'warning';
            this.autoHide();
        },

        toastError(
            message,
            title = 'Error',
        ) {
            this.visible = true;
            this.message = message;
            this.title = title;
            this.bgClass = 'error';
            this.autoHide();
        },

        toastInfo(
            message,
            title = 'Information',
        ) {
            this.visible = true;
            this.message = message;
            this.title = title;
            this.bgClass = 'info';
            this.autoHide();
        },

        autoHide() {
            // Auto-hide the toast after 3 seconds
            setTimeout(() => {
                this.visible = false;
            }, 3000);
        },

        closeToast() {
            this.visible = false;
        },
    },
};
</script>

<style scoped>
.fade-enter-active, .fade-leave-active {
    transition: opacity 0.5s;
}
.fade-enter, .fade-leave-to {
    opacity: 0;
}

#toast {
    top: 1rem !important;
    left: 42%
}

.success {
    background-color: #22c55e !important;
}

.warning {
    background-color: #eab308 !important;
}

.error {
    background-color: #ef4444 !important;
}

.info {
    background-color: #3b82f6 !important;
}
</style>
