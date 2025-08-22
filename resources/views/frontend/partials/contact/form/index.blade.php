<form
    id="contactForm"
    class="space-y-6"
    x-data="contactForm()"
    @submit.prevent="submit"
>
    <div>
        <label for="name" class="block mb-2 text-gray-700 font-bold">Name</label>
        <input type="text" id="name" x-model="name"
               required
               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:border-green-400 focus:shadow-outline"
               placeholder="Zach S.">
        <div x-show="errors.name" class="text-sm text-red-400 mt-0" x-text="errors.name"></div>
    </div>

    <div>
        <label for="email" class="block mb-2 text-gray-700 font-bold">Email</label>
        <input type="email" id="email" x-model="email"
               required
               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline invalid:[&:not(:placeholder-shown)]:border-red-500"
               placeholder="example@email.com">
        <div x-show="errors.email" class="text-sm text-red-400 mt-0" x-text="errors.email"></div>
    </div>

    <div>
        <label for="message" class="block mb-2 text-gray-700 font-bold">Message</label>
        <textarea id="message" x-model="message"
                  required
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                  placeholder="What's on your mind?"></textarea>
        <div x-show="errors.message" class="text-sm text-red-400 mt-0" x-text="errors.message"></div>
    </div>

    <button type="submit"
            id="submit"
            :disabled="loading"
            class="bg-green-500 hover:bg-green-700 disabled:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus-shadow-outline">
        Submit
    </button>

    <p x-show="success" class="mt-10 text-center text-green-500 font-bold" x-transition>
        Your feedback is successfully sent!
    </p>

    <p x-show="error" class="mt-10 text-center text-red-500 font-bold" x-transition>
        Form is not sent due to an error. Please call us on our number above or try again later
    </p>
</form>

<script>
    function contactForm() {
        return {
            name: '',
            email: '',
            message: '',
            loading: false,
            success: false,
            error: false,
            errors: {
                message: '',
                name: '',
                email: '',
            },
            submit() {
                this.loading = true;
                this.success = false;
                this.error = false;

                axios.post('/api/contact', {
                    name: this.name.trim(),
                    email: this.email.trim(),
                    message: this.message.trim()
                })
                    .then(() => {
                        this.success = true;
                        this.name = '';
                        this.email = '';
                        this.message = '';
                    })
                    .catch((e) => {
                        this.error = true;

                        if (e.response.status === HttpStatusCode.UnprocessableEntity) {
                            this.errors = e.response.data.errors;
                        }
                    })
                    .finally(() => {
                        this.loading = false;
                    });
            }
        }
    }
</script>
