@extends('layouts.admin.app')

@section('content')
    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-end mb-2">
            <a class="p-3 bg-gray-500 hover:bg-gray-700 rounded-lg text-white" href="{{ route('admin.user.create') }}">
                Add user
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
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Admin
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Created at
                    </th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $user->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->email }}
                        </td>
                        <td class="px-6 py-4">
                            @if($user->is_super_admin)
                                <svg class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            @else
                                {{-- else show red icon --}}
                                <svg class="h-8 w-8 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->created_at->format('d-m-Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end space-x-2">
                                <a href="{{ route('admin.user.edit', $user->id) }}"
                                   class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-lg text-white">
                                    Edit
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
