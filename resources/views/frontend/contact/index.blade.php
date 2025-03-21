@extends('layouts.frontend.app')

@section('content')
    <h1 class="py-12 text-6xl text-center">
        Let's talk!
    </h1>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="py-12 px-6">
            @include('partials.frontend.contact.index')

            <div class="block lg:hidden my-8">
                @include('partials.frontend.contact.form')
            </div>

            @include('partials.frontend.contact.opening-hours')
        </div>

        <div class="hidden lg:block p-12">
            @include('partials.frontend.contact.form')
        </div>
    </div>
@endsection

@vite('resources/js/contact/form/submit.js')
