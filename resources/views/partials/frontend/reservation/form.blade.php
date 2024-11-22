<div class="w-full">
    <h3 class="mb-4 text-xl font-bold text-blue-500">Make reservation</h3>

    <form method="POST" action="{{ route('reservation.store') }}">
        @csrf

        <div class="sm:col-span-6">
            <label for="first_name" class="block text-sm font-medium text-gray-700"> First name </label>
            <div class="mt-1">
                <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}"
                       class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('first_name') border-red-400 @enderror" />
            </div>
        </div>
        @error('first_name')
        <div class="text-sm text-red-400">{{ $message }}</div>
        @enderror

        <div class="sm:col-span-6">
            <label for="last_name" class="block text-sm font-medium text-gray-700"> Last name </label>
            <div class="mt-1">
                <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}"
                       class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('last_name') border-red-400 @enderror" />
            </div>
        </div>
        @error('last_name')
        <div class="text-sm text-red-400">{{ $message }}</div>
        @enderror

        <div class="sm:col-span-6">
            <label for="email" class="block text-sm font-medium text-gray-700"> Email </label>
            <div class="mt-1">
                <input type="text" id="email" name="email" value="{{ old('email') }}"
                       class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('mobile_number') border-red-400 @enderror" />
            </div>
        </div>
        @error('email')
        <div class="text-sm text-red-400">{{ $message }}</div>
        @enderror

        <div class="sm:col-span-6">
            <label for="mobile_number" class="block text-sm font-medium text-gray-700"> Phone number </label>
            <div class="mt-1">
                <input type="text" id="mobile_number" name="mobile_number" value="{{ old('mobile_number') }}"
                       class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('mobile_number') border-red-400 @enderror" />
            </div>
        </div>
        @error('mobile_number')
        <div class="text-sm text-red-400">{{ $message }}</div>
        @enderror

        <div class="sm:col-span-6">
            <label for="reservation_date" class="block text-sm font-medium text-gray-700"> Date </label>
            <div class="mt-1">
                <input type="datetime-local" id="reservation_date" name="reservation_date"
                       value="{{ old('reservation_date') }}"
                       min="{{ $minDate->format('Y-m-d H:i:s') }}"
                       max="{{ $maxDate->format('Y-m-d H:i:s') }}"
                       class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('reservation_date') border-red-400 @enderror" />
            </div>
        </div>
        <span class="text-xs">Pleas choose a time between 17.00 and 24.00</span>
        @error('reservation_date')
        <div class="text-sm text-red-400">{{ $message }}</div>
        @enderror

        <div class="sm:col-span-6">
            <label for="time_slot" class="block text-sm font-medium text-gray-700"> Choose a suitable time </label>
            <div class="mt-1">
                <select
                    name="time_slot"
                    id="time_slot"
                    class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('time_slot') border-red-400 @enderror"
                >
                    <option value="1" selected>16.00 till 18.00</option>
                    <option value="2">18.30 till 20.30</option>
                </select>
            </div>
        </div>
        @error('time_slot')
        <div class="text-sm text-red-400">{{ $message }}</div>
        @enderror

        <div class="sm:col-span-6">
            <label for="total_guests" class="block text-sm font-medium text-gray-700"> Total guests </label>
            <div class="mt-1">
                <input type="number" id="total_guests" name="total_guests" value="{{ old('total_guests') }}"
                       class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('guest_number') border-red-400 @enderror" />
            </div>
        </div>
        @error('total_guests')
        <div class="text-sm text-red-400">{{ $message }}</div>
        @enderror

        <div class="sm:col-span-6">
            <label for="note" class="block text-sm font-medium text-gray-700"> note </label>
            <div class="mt-1">
                <textarea
                    id="note"
                    name="note"
                    class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('note') border-red-400 @enderror"
                ></textarea>
            </div>
        </div>
        @error('note')
        <div class="text-sm text-red-400">{{ $message }}</div>
        @enderror

        <div class="mt-6 flex justify-end">
            <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 rounded-lg text-white">Make reservation</button>
        </div>
    </form>
</div>
