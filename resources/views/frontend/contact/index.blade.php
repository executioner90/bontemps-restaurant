@extends('layouts.frontend.app')

@section('content')
    <h1 class="py-12 text-6xl text-center">
        Let's talk!
    </h1>

    <div class="grid grid-cols-2">
        <div class="py-12 pr-12">
            @include('partials.frontend.contact.index')

            @include('partials.frontend.contact.opening-hours')
        </div>

        <div class="p-12">
            <div class="flex justify-center items-center shadow-lg bg-green-400 rounded-lg">
                <div class="bg-white p-8 w-96">
                    @include('partials.frontend.contact.hot')

                    @include('partials.frontend.contact.form')
                </div>
            </div>
        </div>
    </div>
@endsection

@vite('resources/js/contact/form/submit.js')
