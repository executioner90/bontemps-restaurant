@extends('layouts.frontend.app')

@section('content')
    <div class="container w-full px-5 py-6 mx-auto">
        <div class="grid lg:grid-cols-4 gap-y-6">
            @foreach($menus as $menu)
                <a href="{{ route('menus.show', $menu->name) }}">
                    <div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg">
                        <img class="w-full h-48" src="{{ asset(Storage::url($menu->image)) }}"
                             alt="Menu image"/>
                        <div class="px-6 py-4">
                            <div class="flex mb-2">
                                <span class="px-4 py-0.5 text-sm bg-red-500 rounded-full text-red-50">Menu</span>
                            </div>
                            <h4 class="mb-3 text-xl font-semibold tracking-tight text-green-600 hover:text-green-400 uppercase">
                                {{ $menu->name }}
                            </h4>
                            <p class="leading-normal text-gray-700">{{ $menu->description }}.</p>
                        </div>
                        <div class="flex items-center justify-between p-4">
                            <span class="text-xl text-green-600">&euro; {{ $menu->price }}</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
