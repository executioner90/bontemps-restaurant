<x-admin.layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end mb-2">
                <a class="p-3 bg-gray-500 hover:bg-gray-700 rounded-lg text-white" href="{{ route('admin.reservations.create') }}">
                    Add reservation
                </a>
            </div>
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            First name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Last name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Mobile number
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Date
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Menu(s)
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Table
                        </th>
                        <th scope="col" class="px-6 py-3">
                            total guests
                        </th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($reservations as $reservation)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $reservation->first_name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $reservation->last_name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $reservation->mobile_number }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $reservation->reservation_date }}
                            </td>
                            <td class="px-6 py-4">
                                @foreach($reservation->menus as $index => $menu)
                                    @php($index++)
                                    {{ $index . "- " . $menu->name }}
                                    <br>
                                @endforeach
                            </td>
                            <td class="px-6 py-4">
                                {{ $reservation->table->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $reservation->guest_number }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-end space-x-2">
                                    <a href="{{ route('admin.reservations.edit', $reservation->id) }}"
                                       class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-lg text-white">
                                        Edit
                                    </a>
                                    <form class="px-4 py-2 bg-red-500 hover:bg-red-700 rounded-lg text-white"
                                          method="POST"
                                          action="{{ route('admin.reservations.destroy', $reservation->id) }}"
                                          onsubmit="return confirm('Do you really want to delete the reservation of {{ $reservation->first_name . " " . $reservation->last_name  }}?')">
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
    </div>
</x-admin.layout>
