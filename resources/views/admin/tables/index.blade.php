@extends('layouts.admin.app')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-end mb-2">
            <a class="p-3 bg-gray-500 hover:bg-gray-700 rounded-lg text-white" href="{{ route('admin.table.create') }}">
                Add table
            </a>
        </div>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Guest number
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($tables as $table)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $table->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $table->guest_number }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $table->status }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end space-x-2">
                                <a href="{{ route('admin.table.edit', $table->id) }}"
                                   class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-lg text-white">
                                    Edit
                                </a>
                                <form class="px-4 py-2 bg-red-500 hover:bg-red-700 rounded-lg text-white"
                                      method="POST"
                                      action="{{ route('admin.table.destroy', $table->id) }}"
                                      onsubmit="return confirm('Do you really want to delete {{ $table->name }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
