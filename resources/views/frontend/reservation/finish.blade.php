@extends('layouts.frontend.app')

@section('content')
    <div class="flex flex-col justify-center items-center px-4">
        <div class="bg-white shadow-md rounded-lg p-6 max-w-2xl w-full text-center">
            <h1 class="text-green-400 text-2xl font-bold mb-4">Thank You for Your Reservation!</h1>

            <p class="text-gray-700 mb-6">We’ve successfully received your reservation. Below are the next steps:</p>

            <div class="space-y-4">
                <div class="bg-green-100 text-green-700 border-l-4 border-green-400 p-4 rounded">
                    <p class="font-semibold">Alert:</p>
                    <p>Two days before your reservation date, you will receive a confirmation email.</p>
                </div>

                <div class="bg-blue-100 text-blue-700 border-l-4 border-blue-500 p-4 rounded">
                    <p class="font-semibold">Reminder:</p>
                    <p>Three hours before your reservation time, you will receive a confirmation call.</p>
                </div>
            </div>

            <div class="mt-6">
                <p class="text-gray-600">If you have any questions or need to make changes, feel free to contact us.</p>
            </div>

            <div class="mt-8">
                <!-- Placeholder for image -->
                <div class="bg-gray-200 rounded-lg flex items-center justify-center">
                    <img class="h-64" src="{{ asset('assets/images/thank-you.jpg') }}" alt="Thank You!">
                </div>
            </div>
        </div>
    </div>

@endsection
