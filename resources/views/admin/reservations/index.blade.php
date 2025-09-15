@extends('layouts.admin.app')

@section('content')
    <div
         x-data="reservationFilter()"
         x-init="fetchReservations()">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">

            <!-- Filters + Add button -->
            <div class="flex justify-between mb-4">
                <div class="flex">
                    <template x-for="option in filters" :key="option.value">
                        <button
                            @click="await setFilter(option.value)"
                            :class="filter === option.value
                                ? 'bg-blue-600 text-white'
                                : 'bg-gray-200 text-gray-700 hover:bg-gray-300'"
                            class="px-3 py-1 text-sm font-medium"
                            x-text="option.label">
                        </button>
                    </template>

                    <div>
                        <x-admin.form.input
                            x-model="search"
                            @input.debounce.500ms="fetchReservations"
                            id="search"
                            class="block w-full h-full ml-2 transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5"
                            type="text"
                            name="search"
                            placeholder="Search by name"
                        />
                    </div>
                </div>

                <a class="p-3 bg-gray-500 hover:bg-gray-700 rounded-lg text-white"
                   href="{{ route('admin.reservation.create') }}">
                    Add reservation
                </a>
            </div>

            <!-- Reservations table -->
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="px-6 py-3">First name</th>
                        <th class="px-6 py-3">Last name</th>
                        <th class="px-6 py-3">Mobile number</th>
                        <th class="px-6 py-3">Confirmed</th>
                        <th class="px-6 py-3">Date</th>
                        <th class="px-6 py-3">From</th>
                        <th class="px-6 py-3">Until</th>
                        <th class="px-6 py-3">Table(s)</th>
                        <th class="px-6 py-3">Total guests</th>
                        <th class="px-6 py-3">Note</th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody x-show="loading">
                        <tr>
                            <td colspan="11" class="text-center p-4">Loading...</td>
                        </tr>
                    </tbody>

                    <tbody x-show="!loading">
                    <!-- Empty -->
                    <template x-if="!loading && reservations.length === 0">
                        <x-admin.table.feedback colspan="11" />
                    </template>

                    <!-- Data -->
                    <template x-for="reservation in reservations" :key="reservation.id">
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                x-text="reservation.first_name"></td>
                            <td class="px-6 py-4" x-text="reservation.last_name"></td>
                            <td class="px-6 py-4" x-text="reservation.mobile_number"></td>
                            <td class="px-6 py-4" x-text="reservation.status === {{ $reservationConfirmed }} ? reservation.status_changed_at : '-'"></td>
                            <td class="px-6 py-4" x-text="reservation.date"></td>
                            <td class="px-6 py-4" x-text="reservation.time_slots[0]?.from"></td>
                            <td class="px-6 py-4" x-text="reservation.time_slots[0]?.till"></td>
                            <td class="px-6 py-4"
                                x-text="reservation.time_slots.map(ts => ts.table.number).join(', ')"></td>
                            <td class="px-6 py-4" x-text="reservation.total_guests"></td>
                            <td class="px-6 py-4" x-text="reservation.note"></td>
                            <td class="px-6 py-4">
                                <div class="flex justify-end space-x-2">
                                    <a :href="`/admin/reservation/${reservation.id}/order`"
                                       class="px-4 py-2 bg-blue-500 hover:bg-blue-700 rounded-lg text-white"
                                       x-show="filter === 'today'"
                                    >
                                        Order
                                    </a>
                                    <a :href="`/admin/reservation/${reservation.id}/edit`"
                                       class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-lg text-white">
                                        Edit
                                    </a>
                                    <form :action="`/admin/reservation/${reservation.id}`"
                                          method="POST"
                                          @submit.prevent="deleteReservation(reservation.id)"
                                          class="px-4 py-2 bg-red-500 hover:bg-red-700 rounded-lg text-white mb-0"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    </template>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@vite('resources/js/admin/reservation/index.js')
