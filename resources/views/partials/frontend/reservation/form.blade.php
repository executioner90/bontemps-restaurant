<div class="w-full">
    <h3 class="mb-4 text-xl font-bold text-green-400">Make reservation</h3>

    <div class="bg-blue-100 text-blue-800 text-center p-4 mb-4 border border-blue-500 rounded-lg">
        <strong class="font-semibold">Notice:</strong> For reservations with more than {{ $maxCapacity }} guests, please
        <a href="{{ route('contact') }}" class="text-blue-800 underline font-medium">contact us</a> for customized arrangements.
    </div>

    <form method="POST" action="{{ route('reservation.store') }}">
        @csrf
        @honeypot

        <div class="sm:col-span-6">
            <label for="first_name" class="block text-sm font-medium text-gray-700"> First name </label>
            <div class="mt-1">
                <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}"
                       class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('first_name') border-red-400 @enderror"/>
            </div>
        </div>
        @error('first_name')
        <div class="text-sm text-red-400">{{ $message }}</div>
        @enderror

        <div class="sm:col-span-6 mt-3">
            <label for="last_name" class="block text-sm font-medium text-gray-700"> Last name </label>
            <div class="mt-1">
                <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}"
                       class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('last_name') border-red-400 @enderror"/>
            </div>
        </div>
        @error('last_name')
        <div class="text-sm text-red-400">{{ $message }}</div>
        @enderror

        <div class="sm:col-span-6 mt-3">
            <label for="email" class="block text-sm font-medium text-gray-700"> Email </label>
            <div class="mt-1">
                <input type="text" id="email" name="email" value="{{ old('email') }}"
                       class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('mobile_number') border-red-400 @enderror"/>
            </div>
        </div>
        @error('email')
        <div class="text-sm text-red-400">{{ $message }}</div>
        @enderror

        <div class="sm:col-span-6 mt-3">
            <label for="mobile_number" class="block text-sm font-medium text-gray-700"> Phone number </label>
            <div class="mt-1">
                <input type="text" id="mobile_number" name="mobile_number" value="{{ old('mobile_number') }}"
                       class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('mobile_number') border-red-400 @enderror"/>
            </div>
        </div>
        @error('mobile_number')
        <div class="text-sm text-red-400">{{ $message }}</div>
        @enderror

        <div class="sm:col-span-6 mt-3">
            <label for="total_guests" class="block text-sm font-medium text-gray-700"> Total guests </label>
            <div class="mt-1">
                <input type="number" id="total_guests" name="total_guests" value="{{ old('total_guests') }}"
                       class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('guest_number') border-red-400 @enderror"/>
            </div>
        </div>
        @error('total_guests')
        <div class="text-sm text-red-400">{{ $message }}</div>
        @enderror

        <div class="sm:col-span-6 mt-3">
            <label for="date" class="block text-sm font-medium text-gray-700"> Date </label>
            <div class="mt-1">
                <input type="date" id="date" name="date"
                       value="{{ old('date') }}"
                       min="{{ $minDate->format('Y-m-d') }}"
                       max="{{ $maxDate->format('Y-m-d') }}"
                       class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('date') border-red-400 @enderror"/>
            </div>
        </div>
        @error('date')
        <div class="text-sm text-red-400">{{ $message }}</div>
        @enderror

        <div class="sm:col-span-6 mt-3">
            <label for="time_slot" class="block text-sm font-medium text-gray-700"> Choose a suitable time </label>
            <div class="mt-1">
                <select
                        name="time_slot"
                        id="time_slot"
                        disabled
                        class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('time_slot') border-red-400 @enderror"
                >
                    <option selected value="0">Select time</option>
                </select>
            </div>
            <small>Fill first total guests and date.</small>
            <div>
                <small id="availableTimeMessage" class="text-red-400"></small>
            </div>
        </div>
        @error('time_slot')
        <div class="text-sm text-red-400">{{ $message }}</div>
        @enderror

        <div class="sm:col-span-6 mt-3">
            <label for="note" class="block text-sm font-medium text-gray-700"> Note </label>
            <div class="mt-1">
                <textarea id="note" name="note" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('note') border-red-400 @enderror"></textarea>
            </div>
        </div>
        @error('note')
        <div class="text-sm text-red-400">{{ $message }}</div>
        @enderror

        <div class="mt-6 flex justify-end">
            <x-frontend.global.reservation.button is-button></x-frontend.global.reservation.button>
        </div>
    </form>
</div>

@vite('resources/js/reservation/availableTimes.js')