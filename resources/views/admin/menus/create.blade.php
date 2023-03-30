<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1>Create menu</h1>
            {{-- back to index page --}}
            <div class="flex justify-end mb-2">
                <a class="p-3 bg-gray-500 hover:bg-gray-700 rounded-lg text-white" href="{{ route('admin.menus.index') }}">
                    Back
                </a>
            </div>
            {{-- form --}}
            <div class="mb-20 bg-slate-100 rounded">
                <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10 p-2">
                    <form method="POST" action="{{ route('admin.menus.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="sm:col-span-6">
                            <label for="name" class="block text-sm font-medium text-gray-700"> Name </label>
                            <div class="mt-1">
                                <input type="text" id="name" name="name" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('name') border-red-400 @enderror" />
                            </div>
                        </div>
                        @error('Name')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                        <div class="sm:col-span-6">
                            <label for="special" class="block text-sm font-medium text-gray-700"> Special </label>
                            <div class="mt-1">
                                <input type="checkbox" id="special" name="special" class="block transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('special') border-red-400 @enderror" />
                            </div>
                        </div>
                        @error('special')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                        <div class="sm:col-span-6">
                            <label for="meals" class="block text-sm font-medium text-gray-700"> Meals </label>
                            <div class="mt-1">
                                <select id="meals" name="meals[]" class="form-multiselect block w-full mt-1 @error('meals') border-red-400 @enderror" multiple>
                                    @foreach($meals as $meal)
                                        <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @error('meals')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                        <div class="sm:col-span-6">
                            <label for="title" class="block text-sm font-medium text-gray-700"> Image </label>
                            <div class="mt-1">
                                <input type="file" id="image" name="image" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('image') border-red-400 @enderror" />
                            </div>
                        </div>
                        @error('image')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                        <div class="sm:col-span-6">
                            <label for="price" class="block text-sm font-medium text-gray-700"> Price </label>
                            <div class="mt-1">
                                <input type="number" min="0.00" max="500.00" step="0.1" id="price" name="price" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('price') border-red-400 @enderror" />
                            </div>
                        </div>
                        @error('price')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                        <div class="sm:col-span-6 pt-5">
                            <label for="body" class="block text-sm font-medium text-gray-700">Description</label>
                            <div class="mt-1">
                                <textarea id="body" rows="3" name="description" class="shadow-sm focus:ring-indigo-500 appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md @error('description') border-red-400 @enderror"></textarea>
                            </div>
                        </div>
                        @error('description')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                        <div class="mt-6">
                            <button type="submit" class="px-4 py-2 bg-gray-500 hover:bg-gray-700 rounded-lg text-white  ">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
