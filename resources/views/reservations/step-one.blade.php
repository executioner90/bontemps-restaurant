<x-guest-layout>
    <div class="container w-full px-5 py-6 mx-auto">
        <div class="flex items-center min-h-screen bg-gray-50">
            <div class="flex-1 h-full max-w-4xl mx-auto bg-white rounded-lg shadow-xl">
                <div class="flex flex-col md:flex-row">
                    <div class="h-32 md:h-auto md:w-1/2">
                        <img class="object-cover w-full h-full" src="https://cdn.pixabay.com/photo/2021/01/15/17/01/green-5919790_960_720.jpg" alt="">
                    </div>
                    <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                        <div class="w-full">
                            <h3 class="mb-4 text-xl font-bold text-blue-600">Make reservation</h3>

                            <div class="w-full bg-gray-200 rounded-full">
                                <div class="w-40 p-1 text-xs font-medium leading-none text-center text-blue-100 bg-blue-600 rounded-lg">
                                    step 1
                                </div>
                            </div>

                            <form method="POST" action="{{ route('reservations.store.step.one') }}">
                                @csrf
                                <div class="sm:col-span-6">
                                    <label for="first_name" class="block text-sm font-medium text-gray-700"> First name </label>
                                    <div class="mt-1">
                                        <input type="text" id="first_name" name="first_name" value="{{ $reservation->first_name ?? '' }}"
                                               class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('first_name') border-red-400 @enderror" />
                                    </div>
                                </div>
                                @error('first_name')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                                <div class="sm:col-span-6">
                                    <label for="last_name" class="block text-sm font-medium text-gray-700"> Last name </label>
                                    <div class="mt-1">
                                        <input type="text" id="last_name" name="last_name" value="{{ $reservation->last_name ?? '' }}"
                                               class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('last_name') border-red-400 @enderror" />
                                    </div>
                                </div>
                                @error('last_name')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                                <div class="sm:col-span-6">
                                    <label for="mobile_number" class="block text-sm font-medium text-gray-700"> Phone number </label>
                                    <div class="mt-1">
                                        <input type="text" id="mobile_number" name="mobile_number" value="{{ $reservation->mobile_number ?? '' }}"
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
                                               value="{{ $reservation ? $reservation->reservation_date : '' }}"
                                               min="{{ $minDate->format('Y-m-d\TH:i:s') }}"
                                               max="{{ $maxDate->format('Y-m-d\TH:i:s') }}"
                                               class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('reservation_date') border-red-400 @enderror" />
                                    </div>
                                </div>
                                @error('reservation_date')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                                <div class="sm:col-span-6">
                                    <label for="guest_number" class="block text-sm font-medium text-gray-700"> Guest number </label>
                                    <div class="mt-1">
                                        <input type="number" id="guest_number" name="guest_number" value="{{ $reservation->guest_number ?? '' }}"
                                               class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('guest_number') border-red-400 @enderror" />
                                    </div>
                                </div>
                                @error('guest_number')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                                <div class="mt-6 flex justify-end">
                                    <button type="submit" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Next</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
