<form id="contactForm" class="space-y-6">
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
        <textarea id="message"
                  required
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                  placeholder="What's on your mind?"></textarea>
    </div>
    <button type="submit"
            id="submit"
            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus-shadow-outline">
        Submit
    </button>

    <p id="success" class="mt-10 text-center hidden">Your feedback is <span class="text-green-500 font-bold">successfully</span> sent!</p>
    <p id="error" class="mt-10 text-center hidden">Form is not sent due to an <span class="text-red-500 font-bold">error</span>. Please call us on our number above or try again later</p>
</form>
