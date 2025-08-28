@extends('layouts.frontend.app')

@section('header.image')
    <section>
        @include('frontend.partials.home.header.welcome')
    </section>
@endsection

@section('content')
    <section class="bg-white">
        <x-frontend.menu is-special />
    </section>

    <section class="bg-white">
        @include('frontend.partials.home.our-story')
    </section>

    <section class="bg-gray-50">
        @include('frontend.partials.home.about-us')
    </section>
@endsection
