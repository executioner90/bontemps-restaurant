<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1>Create table</h1>
            {{-- back to index page --}}
            <div class="flex justify-end mb-2">
                <a class="p-3 bg-gray-500 hover:bg-gray-700 rounded-lg text-white"
                   href="{{ route('admin.tables.index') }}">
                    Back
                </a>
            </div>
            {{-- form --}}
            <div class="mb-20 bg-slate-100 rounded">
                <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10 p-2">
                    <form method="POST" action="{{ route('admin.tables.store') }}">
                        @csrf
                        <div class="sm:col-span-6">
                            <label for="name" class="block text-sm font-medium text-gray-700"> Name </label>
                            <div class="mt-1">
                                <input type="text" id="name" name="name"
                                       class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('name') border-red-400 @enderror"/>
                            </div>
                        </div>
                        @error('name')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                        <div class="sm:col-span-6">
                            <label for="guest_number" class="block text-sm font-medium text-gray-700"> Guest
                                number </label>
                            <div class="mt-1">
                                <input type="text" id="guest_number" name="guest_number"
                                       class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('guest_number') border-red-400 @enderror"/>
                            </div>
                        </div>
                        @error('guest_number')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                        <div class="sm:col-span-6">
                            <label for="status" class="block text-sm font-medium text-gray-700"> Status </label>
                            <div class="mt-1">
                                <select id="status" name="status"
                                        class="form-multiselect block w-full mt-1 @error('status') border-red-400 @enderror">
                                    @foreach(App\Enums\TableStatus::cases() as $status)
                                        <option value="{{ $status->value }}">{{ $status->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @error('status')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                        <div class="mt-6">
                            <button type="submit"
                                    class="px-4 py-2 bg-gray-500 hover:bg-gray-700 rounded-lg text-white  ">Create
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
