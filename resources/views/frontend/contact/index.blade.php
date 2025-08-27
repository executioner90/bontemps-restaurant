@extends('layouts.frontend.app')

@section('content')
    <h1 class="py-12 text-6xl text-center">
        Let's talk!
    </h1>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="py-12 px-6">
            @include('frontend.partials.contact.index')

            <div class="block lg:hidden my-8">
                @include('frontend.partials.contact.form')
            </div>

            @include('frontend.partials.contact.opening-hours')
        </div>

        <div class="hidden lg:block p-12">
            @include('frontend.partials.contact.form')
        </div>
    </div>
@endsection
