<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1>Create reservation</h1>
            {{-- back to index page --}}
            <div class="flex justify-end mb-2">
                <a class="p-3 bg-gray-500 hover:bg-gray-700 rounded-lg text-white" href="{{ route('admin.reservations.index') }}">
                    Back
                </a>
            </div>
            {{-- form --}}
            <div class="mb-20 bg-slate-100 rounded">
                <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
                    <form method="POST" action="{{ route('admin.reservations.store') }}">
                        @csrf
                        <div class="sm:col-span-6">
                            <label for="first_name" class="block text-sm font-medium text-gray-700"> First name </label>
                            <div class="mt-1">
                                <input type="text" id="first_name" name="first_name" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                        </div>
                        <div class="sm:col-span-6">
                            <label for="last_name" class="block text-sm font-medium text-gray-700"> Last name </label>
                            <div class="mt-1">
                                <input type="text" id="last_name" name="last_name" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                        </div>
                        <div class="sm:col-span-6">
                            <label for="mobile_number" class="block text-sm font-medium text-gray-700"> Phone number </label>
                            <div class="mt-1">
                                <input type="text" id="mobile_number" name="mobile_number" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                        </div>
                        <div class="sm:col-span-6">
                            <label for="reservation_date" class="block text-sm font-medium text-gray-700"> Date </label>
                            <div class="mt-1">
                                <input type="datetime-local" id="reservation_date" name="reservation_date" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                        </div>
                        <div class="sm:col-span-6">
                            <label for="guest_number" class="block text-sm font-medium text-gray-700"> Guest number </label>
                            <div class="mt-1">
                                <input type="number" id="guest_number" name="guest_number" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                        </div>
                        <div class="sm:col-span-6">
                            <label for="table_id" class="block text-sm font-medium text-gray-700"> Table </label>
                            <div class="mt-1">
                                <select id="table_id" name="table_id" class="form-multiselect block w-full mt-1">
                                    @foreach($tables as $table)
                                        <option value="{{ $table->id }}">{{ $table->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mt-6">
                            <button type="submit" class="px-4 py-2 bg-gray-500 hover:bg-gray-700 rounded-lg text-white">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
