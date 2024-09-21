<x-guest-layout>
    <div class="container w-full px-5 py-6 mx-auto">
        <h1 class="py-12 text-6xl text-center">
            Let's talk!
        </h1>

        <div class="grid grid-cols-2">
            <div class="py-12 pr-12">
                <h2 class="text-3xl pb-6">We’d Love to Hear From You!</h2>

                <p class="pb-3">
                    Whether you have a question, a suggestion, or just want to say hello, we’re here for you. Feel free
                    to reach out directly, and we’ll get back to you as soon as possible. Your feedback is important to
                    us, and we’re always happy to help.
                </p>

                <p class="text-green-500 font-semibold pb-12">Looking forward to connecting with you!</p>

                <p class="text-2xl">Opening <span class="font-semibold">Hours</span></p>

                <p>
                    Tues - Fri: 4pm - 12am <br>
                    Sat: 4pm - 2am <br>
                    Mon: <span class="text-red-600">Closed</span>
                </p>
            </div>

            <div class="py-12 px-12 rounded-full">
                <div class="flex justify-center items-center shadow-lg bg-green-400 rounded-lg">
                    <div class="bg-white p-8 w-96">
                        <div class="flex justify-between items-center mb-4">
                            <div class="flex items-center">
                                <span class="text-sm font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500">Bontemps</span>

                                <div class="ml-4">
                                    <p class="font-bold text-lg">Customer service</p>
                                    <p class="text-gray-500">+123 456 789</p>
                                    <p class="text-gray-500">info@bontemps.nl</p>
                                </div>
                            </div>
                            <div class="bg-red-500 text-white font-bold px-3 py-1 rounded-full">
                                HOT
                            </div>
                        </div>
                        <form class="space-y-6">
                            <div>
                                <label for="name" class="block mb-2 text-gray-700 font-bold">Name</label>
                                <input type="text" id="name"
                                       required
                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:border-green-400 focus:shadow-outline"
                                       placeholder="Zach S.">
                            </div>
                            <div>
                                <label for="email" class="block mb-2 text-gray-700 font-bold">Email</label>
                                <input type="email" id="email"
                                       required
                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline invalid:[&:not(:placeholder-shown)]:border-red-500"
                                       placeholder="example@email.com">
                            </div>
                            <div>
                                <label for="text" class="block mb-2 text-gray-700 font-bold">Message</label>
                                <textarea id="text"
                                          required
                                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                       placeholder="What's on your mind?"></textarea>
                            </div>
                            <button type="submit"
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus-shadow-outline">
                                Submit
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
