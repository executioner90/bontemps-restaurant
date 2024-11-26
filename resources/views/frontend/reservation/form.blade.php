@extends('layouts.frontend.app')

@section('content')
    <div class="flex items-center min-h-screen bg-gray-50">
        <div class="flex-1 h-full max-w-4xl mx-auto bg-white rounded-lg shadow-xl">
            <div class="flex flex-col md:flex-row">
                <div class="h-32 md:h-auto md:w-1/2">
                    <img
                        class="object-cover w-full h-full"
                        src="{{ asset('/asset/images/reservation.jpg') }}"
                        alt="Make reservation"
                    >
                </div>

                <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                    @include('partials.frontend.reservation.form', [$maxCapacity])
                </div>
            </div>
        </div>
    </div>
@endsection
