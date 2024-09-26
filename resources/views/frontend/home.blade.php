@extends('layouts.frontend.app')

@section('header.image')
    <section>
        @include('partials.frontend.home.header.welcome')
    </section>
@endsection

@section('content')
    <section class="bg-white">
        <x-frontend.home.menus.special></x-frontend.home.menus.special>
    </section>

    <section class="bg-white">
        @include('partials.frontend.home.our-story')
    </section>

    <section class="bg-gray-50">
        @include('partials.frontend.home.about-us')
    </section>


@endsection
